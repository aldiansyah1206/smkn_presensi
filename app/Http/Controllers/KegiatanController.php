<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatan = Kegiatan::orderBy ('name')->paginate(5);
        return view('apps.kegiatan.index', [
               "title" => "Data kegiatan",
               "kegiatan" => $kegiatan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatan= Kegiatan::orderBy ('name')->paginate(5);

        return view("apps.kegiatan.create", [
            "title" => "Tambah Kegiatan",
            "kegiatan" => $kegiatan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:kegiatan,name',
        ]);

        $kegiatan = new Kegiatan;
        $kegiatan->name = $request->name;
        $kegiatan->save();
    
        return redirect()->route("apps.kegiatan.index")->with(['success' => 'Data Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        //
    }
}
