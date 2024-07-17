<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::orderBy ('name')->paginate(5);
        return view('apps.kelas.index', [
               "title" => "Data Kelas",
               "kelas" => $kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::orderBy ('name')->paginate(5);

        return view("apps.kelas.create", [
            "title" => "Tambah Kelas",
            "kelas" => $kelas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:kelas,name',
        ]);

        $kelas = new Kelas;
        $kelas->name = $request->name;
        $kelas->save();
    
        return redirect()->route("apps.kelas.index")->with(['success' => 'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    { 
        return view('apps.kelas.edit', [
            "title" => "Edit Kelas ",
            "kelas" => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:kelas,name,' . $kelas->id,
        ]);
    
        $kelas->name = $request->name;
        $kelas->save();
    
        return redirect()->route('apps.kelas.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
    
        return redirect()->route('apps.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
    
    
}
