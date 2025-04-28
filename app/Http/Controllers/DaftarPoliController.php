<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\User;
use App\Models\JadwalPeriksa;

class DaftarPoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DaftarPoli::where('id_pasien', session()->get('id'))->get();

        foreach ($data as $item) {
            $pasien = User::where('id', $item->id_pasien)->first();
            $jadwalPeriksa = JadwalPeriksa::where('id', $item->id_jadwal)->first();

            $item->pasien = $pasien->name;
            $item->jadwalHari = $jadwalPeriksa->hari;
            $item->jadwalJamMulai = $jadwalPeriksa->jam_mulai;
            $item->jadwalJamSelesai = $jadwalPeriksa->jam_selesai;
            $item->dokter = User::where('id', $jadwalPeriksa->id_dokter)->pluck('name')->first();
        }

        return view('pages.daftar-poli.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jadwal = JadwalPeriksa::all();

        foreach ($jadwal as $item) {
            $item->dokter = User::where('id', $item->id_dokter)->pluck('name')->first();
        }

        return view('pages.daftar-poli.create', [
            'data' => $jadwal
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_jadwal' => 'required|integer',
            'keluhan' => 'required|string'
        ]);

        $latestQueueNumber = DaftarPoli::max('no_antrian');
        $nextQueueNumber = $latestQueueNumber ? $latestQueueNumber + 1 : 1;

        $poli = DaftarPoli::create([
            'id_pasien' => session()->get('id'),
            'id_jadwal' => $validatedData['id_jadwal'],
            'keluhan' => $validatedData['keluhan'],
            'no_antrian' => $nextQueueNumber
        ]);

        return redirect()->route('daftar-poli.index')->with('status', 'Daftar poli data created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DaftarPoli::where('id', $id)->first();
        $jadwalPeriksa = JadwalPeriksa::all();

        foreach ($jadwalPeriksa as $item) {
            $item->dokter = User::where('id', $item->id_dokter)->pluck('name')->first();
        }

        return view('pages.daftar-poli.edit', [
            'data' => $data,
            'jadwalPeriksa' => $jadwalPeriksa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'id_jadwal' => 'required|integer',
            'keluhan' => 'required|string'
        ]);

        $data = DaftarPoli::where('id', $id)->first();

        $data->update([
            'id_jadwal' => $validatedData['id_jadwal'],
            'keluhan' => $validatedData['keluhan']
        ]);

        return redirect()->route('daftar-poli.index')->with('status', 'Daftar poli data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DaftarPoli::where('id', $id)->first();
        $data->delete();

        return redirect()->route('daftar-poli.index')->with('status', 'Daftar poli data deleted successfully!');
    }
}
