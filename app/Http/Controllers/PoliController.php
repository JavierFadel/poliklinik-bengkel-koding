<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Poli::all();

        return view('pages.poli.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.poli.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $poli = Poli::create([
            'nama_poli' => $validatedData['nama_poli'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('poli.index')->with('status', 'Poliklinik data created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Poli::where('id', $id)->first();

        return view('pages.poli.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $data = Poli::where('id', $id)->first();

        $data->update([
            'nama_poli' => $validatedData['nama_poli'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('poli.index')->with('status', 'Poliklinik data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Poli::where('id', $id)->first();
        $data->delete();

        return redirect()->route('poli.index')->with('status', 'Poliklinik data deleted successfully!');
    }
}
