<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;

use Illuminate\Http\Request;


class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::orderBy ('name')->paginate(5);

        return view("apps.jurusan.index", [
            "title" => "Data Jurusan",
            "jurusan" => $jurusan,
     ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan= Jurusan::orderBy ('name')->paginate(5);

        return view("apps.jurusan.create", [
            "title" => "Tambah Jurusan",
            "jurusan" => $jurusan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jurusan,name',
        ]);

        $jurusan = new Jurusan();
        $jurusan->name = $request->name;
        $jurusan->save();
    
        return redirect()->route("apps.jurusan.index")->with(['success' => 'Data berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view("apps.jurusan.edit", [
            "title" => "Edit Jurusan ",
            "jurusan" => $jurusan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jurusan,name,' . $jurusan->id,
        ]);
        $jurusan->name = $request->name;
        $jurusan->save();
        return redirect()->route('apps.jurusan.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jurusan= Jurusan::findOrFail($id); 
        $jurusan->delete();
        return redirect()->route('apps.jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
