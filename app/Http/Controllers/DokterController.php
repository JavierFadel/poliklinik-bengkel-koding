<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Poli;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('status', 2)->get();
        
        foreach ($data as $item) {
            $poliName = Poli::where('id', $item->id_poli)->first();
            $item->poli = $poliName->nama_poli;
        }

        return view('pages.dokter.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poli = Poli::all();

        return view('pages.dokter.create', [
            'poli' => $poli
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'id_poli' => 'nullable|integer',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'alamat' => $validatedData['alamat'],
            'no_hp' => $validatedData['no_hp'],
            'id_poli' => $validatedData['id_poli'],
            'password' => Hash::make('user1234'),
            'status' => 2
        ]);

        return redirect()->route('dokter.index')->with('status', 'Dokter data created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('id', $id)->first();
        $poli = Poli::all();

        return view('pages.dokter.edit', [
            'data' => $data,
            'poli' => $poli
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'id_poli' => 'nullable|integer',
        ]);

        $user = User::where('id', $id)->first();

        $user->update([
            'name' => $validatedData['name'],
            'alamat' => $validatedData['alamat'],
            'no_hp' => $validatedData['no_hp'],
            'id_poli' => $validatedData['id_poli'],
        ]);

        return redirect()->route('dokter.index')->with('status', 'Dokter data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();

        return redirect()->route('dokter.index')->with('status', 'Dokter data deleted successfully!');
    }
}
