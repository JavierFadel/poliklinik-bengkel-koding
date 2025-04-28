<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\User;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Carbon\Carbon;

enum Hari: string {
    case Senin = 'Monday';
    case Selasa = 'Tuesday';
    case Rabu = 'Wednesday';
    case Kamis = 'Thursday';
    case Jumat = 'Friday';
    case Sabtu = 'Saturday';
    case Minggu = 'Sunday';
}

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get jadwal where id_jadwal is in $jadwal->id
        $jadwal = JadwalPeriksa::where('id_dokter', session()->get('id'))->pluck('id');
        $data = DaftarPoli::whereIn('id_jadwal', $jadwal)->get();

        foreach ($data as $item) {
            $item->pasienName = User::where('id', $item->id_pasien)->pluck('name')->first(); 
        }

        return view('pages.periksa.index', [
            'data' => $data
        ]);
    }

    public function combineDayAndTime(Hari $hari, string $time): Carbon {
        // Get the English equivalent of the day from the enum
        $englishDay = $hari->value;
    
        // Start from today and get the next occurrence of the day
        $nextDate = Carbon::now()->next($englishDay);
    
        // Combine the date with the time
        $dateTime = $nextDate->format('Y-m-d') . ' ' . $time;
    
        // Return a Carbon instance of the combined datetime
        return Carbon::createFromFormat('Y-m-d H:i', $dateTime);
    }

    public function riwayatPeriksa()
    {
        $id = session()->get('id');

        $data = JadwalPeriksa::where('id_dokter', $id)
            ->with(['daftarPoli.periksa', 'daftarPoli.pasien'])
            ->get()
            ->flatMap(function ($jadwal) {
                return $jadwal->daftarPoli->flatMap(function ($daftarPoli) {
                    return $daftarPoli->periksa->map(function ($periksa) use ($daftarPoli) {
                        return [
                            'nama_pasien' => $daftarPoli->pasien->name,
                            'tgl_periksa' => $periksa->tgl_periksa,
                            'catatan' => $periksa->catatan,
                        ];
                    });
                });
            });

        // echo json_encode($data); die;
        // foreach ($data as $item) {
        
        //     // foreach ($item as $i) {
        //         echo json_encode($item->tgl_periksa); die;       
        //     // }
        // }

        return view('pages.riwayat.index', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo json_encode($request->all()); die;

        $validatedData = $request->validate([
            'catatan' => 'required|max:200',
        ]);

        $day = '';
        switch ($request->hari) {
            case 'senin':
                $day = 'monday';
                break;
            case 'selasa':
                $day = 'tuesday';
                break;
            case 'rabu':
                $day = 'wednesday';
                break;
            case 'kamis':
                $day = 'thursday';
                break;
            case 'jumat':
                $day = 'friday';
                break;
            case 'sabtu':
                $day = 'saturday';
                break;
            case 'minggu':
                $day = 'sunday';
                break;
            default:
                # code...
                break;
        }

        $nextDate = Carbon::now()->next($day);        

        // Combine the date with the time
        $dateTime = $nextDate->format('Y-m-d') . ' ' . $request->jam_periksa;

        $finalDate = Carbon::createFromFormat('Y-m-d H:i', $dateTime);

        $obat = Obat::where('id', $request->id_obat)->first();
        $biayaPeriksa = $obat->harga + 150000;

        $periksa = Periksa::create([
            'id_daftar_poli' => $request->daftarPoliId,
            'tgl_periksa' => $finalDate,
            'catatan' => $request->catatan,
            'biaya_periksa' => $biayaPeriksa
        ]);

        $detailPeriksa = DetailPeriksa::create([
            'id_periksa' => $periksa->id,
            'id_obat' => $obat->id
        ]);

        return redirect()->route('periksa.index')->with('status', 'Dokumen periksa data created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DaftarPoli::where('id', $id)->first();
        $jadwal = JadwalPeriksa::where('id', $data->id_jadwal)->first();
        $obat = Obat::all();

        return view('pages.periksa.edit', [
            'data' => $data,
            'jadwal' => $jadwal,
            'obat' => $obat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
