<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Obat::all();

        return view('pages.obat.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'nullable|string',
            'harga' => 'required|integer'
        ]);

        $data = Obat::create([
            'nama_obat' => $validatedData['nama_obat'],
            'kemasan' => $validatedData['kemasan'],
            'harga' => $validatedData['harga']
        ]);

        return redirect()->route('obat.index')->with('status', 'Obat data created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Obat::where('id', $id)->first();

        return view('pages.obat.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'nullable|string',
            'harga' => 'required|integer' 
        ]);

        $data = Obat::where('id', $id)->first();

        $data->update([
            'nama_obat' => $validatedData['nama_obat'],
            'kemasan' => $validatedData['kemasan'],
            'harga' => $validatedData['harga']
        ]);

        return redirect()->route('obat.index')->with('status', 'Obat data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Obat::where('id', $id)->first();
        $data->delete();

        return redirect()->route('obat.index')->with('status', 'Obat data deleted successfully!');
    }
}
