<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Kegiatan;
use App\Models\Pembina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function indexPembina(Request $request)
    {
        $query = Pembina::with('user', 'kegiatan');

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            })
            ->orWhereHas('kegiatan', function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%");
            });
        }

        $pembina = $query->paginate(5);
        $kegiatan = Kegiatan::all();
        return view('apps.users.indexPembina', compact('pembina', 'kegiatan'));
    }

    public function indexSiswa(Request $request)
    {
        $query = Siswa::with('user', 'kelas', 'jurusan', 'kegiatan');

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            })
            ->orWhereHas('kelas', function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%");
            })
            ->orWhereHas('jurusan', function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%");
            })
            ->orWhereHas('kegiatan', function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%");
            });
        }

        $siswa = $query->paginate(5);
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $kegiatan = Kegiatan::all();
        return view('apps.users.indexSiswa', compact('siswa', 'kelas', 'jurusan', 'kegiatan'));
    }

    public function createSiswa()
    {
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $kegiatan = Kegiatan::all();
        return view('apps.users.createSiswa', [
            "jurusan" => $jurusan,
            "kelas" => $kelas,
            "kegiatan" => $kegiatan
        ]);
    }

    public function createPembina()
    {
        $kegiatan = Kegiatan::all();
        return view('apps.users.createPembina', [
            "kegiatan" => $kegiatan
        ]);
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jenis_kelamin' => 'required|string|max:10',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $siswa = Siswa::create([
            'user_id' => $user->id,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'kegiatan_id' => $request->kegiatan_id, // Simpan kegiatan_id langsung
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        $kegiatanIds = is_array($request->kegiatan_id) ? $request->kegiatan_id : [$request->kegiatan_id];
        $siswa->kegiatan()->sync($kegiatanIds);
        
        $user->assignRole('siswa');

        return redirect()->route('apps.users.indexSiswa')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function storePembina(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'jenis_kelamin' => 'required|string|max:10',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Pembina::create([
            'user_id' => $user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        $user->assignRole('pembina');

        return redirect()->route('apps.users.indexPembina')->with('success', 'Pembina berhasil ditambahkan');
    }

    public function editSiswa($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $kegiatan = Kegiatan::all();
        return view('apps.users.editSiswa', compact('siswa', 'jurusan', 'kelas', 'kegiatan'));
    }

    public function editPembina($id)
    {
        $pembina = Pembina::with('user')->findOrFail($id);
        $kegiatan = Kegiatan::all();
        return view('apps.users.editPembina', compact('pembina', 'kegiatan'));
    }

    public function updateSiswa(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jenis_kelamin' => 'required|string|max:10',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $siswa->update([
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'kegiatan_id' => $request->kegiatan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('apps.users.indexSiswa')->with('success', 'Siswa berhasil diupdate.');
    }

    public function updatePembina(Request $request, $id)
    {
        $pembina = Pembina::findOrFail($id);
        $user = $pembina->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'jenis_kelamin' => 'required|string|max:10',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);
            // Cek apakah pembina sudah mengelola kegiatan lain (kecuali kegiatan yang sama)
            $pembinaExists = Pembina::where('kegiatan_id', $request->kegiatan_id)
                ->where('id', '!=', $pembina->id)
                ->exists();

            if ($pembinaExists) {
                return redirect()->back()->withErrors('Pembina ini sudah mengelola kegiatan lain.');
            }
        // Update data pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Update data pembina
        $pembina->update([
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('apps.users.indexPembina')->with('success', 'Pembina berhasil diupdate.');
    }

    public function destroySiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->user()->delete(); // Delete the associated user
        $siswa->delete();

        return redirect()->route('apps.users.indexSiswa')->with('success', 'Siswa berhasil dihapus.');
    }

    public function destroyPembina($id)
    {
        $pembina = Pembina::findOrFail($id);
        $pembina->user()->delete(); // Delete the associated user
        $pembina->delete();

        return redirect()->route('apps.users.indexPembina')->with('success', 'Pembina berhasil dihapus.');
    }
}