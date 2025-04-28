<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;

class JadwalPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JadwalPeriksa::where('id_dokter', session()->get('id'))->get();

        return view('pages.jadwal.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_mulai' => 'required|date_format:H:i|after_or_equal:09:00|before_or_equal:21:00',
            'jam_selesai' => 'required|date_format:H:i|after_or_equal:09:00|before_or_equal:21:00',
        ]);

        // echo json_encode($validatedData); die;

        $poli = JadwalPeriksa::create([
            'id_dokter' => session()->get('id'),
            'hari' => $validatedData['hari'],
            'jam_mulai' => $validatedData['jam_mulai'],
            'jam_selesai' => $validatedData['jam_selesai']
        ]);

        return redirect()->route('jadwal.index')->with('status', 'Daftar poli data created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = JadwalPeriksa::where('id', $id)->first();

        return view('pages.jadwal.edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_mulai' => 'required|date_format:H:i|after_or_equal:09:00|before_or_equal:21:00',
            'jam_selesai' => 'required|date_format:H:i|after_or_equal:09:00|before_or_equal:21:00',            
        ]);

        $data = JadwalPeriksa::where('id', $id)->first();

        $data->update([
            'hari' => $validatedData['hari'],
            'jam_mulai' => $validatedData['jam_mulai'],
            'jam_selesai' => $validatedData['jam_selesai']
        ]);

        return redirect()->route('jadwal.index')->with('status', 'Jadwal data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JadwalPeriksa::where('id', $id)->first();
        $data->delete();

        return redirect()->route('jadwal.index')->with('status', 'Jadwal data deleted successfully!');
    }
}