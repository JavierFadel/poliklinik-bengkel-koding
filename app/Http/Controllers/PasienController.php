<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('status', 3)->get();

        return view('pages.pasien.index', [
            'data' => $data
        ]);
    }

    public function indexByDoctor()
    {
        $id = session()->get('id');

        // Retrieve patients directly through relationships
        $data = User::whereIn('id', function ($query) use ($id) {
            $query->select('id_pasien')
                ->from('daftar_poli')
                ->whereIn('id_jadwal', function ($subQuery) use ($id) {
                    $subQuery->select('id')
                        ->from('jadwal_periksa')
                        ->where('id_dokter', $id);
                });
        })->get();

        return view('pages.pasien.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_ktp' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'no_rm' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'alamat' => $validatedData['alamat'],
            'no_ktp' => $validatedData['no_ktp'],
            'no_hp' => $validatedData['no_hp'],
            'no_rm' => $validatedData['no_rm'],
            'password' => Hash::make('user1234'),
            'status' => 3
        ]);

        return redirect()->route('pasien.index')->with('status', 'Pasien data created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('id', $id)->first();

        return view('pages.pasien.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_ktp' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:255',
            'no_rm' => 'nullable|string|max:255',
        ]);

        $user = User::where('id', $id)->first();

        $user->update([
            'name' => $validatedData['name'],
            'alamat' => $validatedData['alamat'],
            'no_ktp' => $validatedData['no_ktp'],
            'no_hp' => $validatedData['no_hp'],
            'no_rm' => $validatedData['no_rm'],
        ]);

        return redirect()->route('pasien.index')->with('status', 'Pasien data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();

        return redirect()->route('pasien.index')->with('status', 'Pasien data deleted successfully!');
    }
}
