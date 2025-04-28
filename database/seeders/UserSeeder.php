<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1: admin
        // 2: dokter
        // 3: user

        DB::table('users')->insert([
            'name' => 'SuperAdmin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'status' => 1
        ]);

        DB::table('poli')->insert([
            'nama_poli' => 'Disini',
            'keterangan' => 'Ya.. disini.'
        ]);

        DB::table('poli')->insert([
            'nama_poli' => 'Disana',
            'keterangan' => 'Ya.. disana.'
        ]);

        DB::table('users')->insert([
            'name' => 'Dokter 1',
            'email' => 'dokterone@example.com',
            'password' => Hash::make('dokter123'),
            'status' => 2,
            'id_poli' => 1,
            'no_hp' => Str::random(12)
        ]);

        DB::table('users')->insert([
            'name' => 'Dokter 2',
            'email' => 'doktertwo@example.com',
            'password' => Hash::make('dokter123'),
            'status' => 2,
            'id_poli' => 2,
            'no_hp' => Str::random(12)
        ]);

        DB::table('users')->insert([
            'name' => 'User 1',
            'email' => 'userone@example.com',
            'password' => Hash::make('user1234'),
            'status' => 3,
            'alamat' => 'Udinus',
            'no_ktp' => Str::random(12),
            'no_hp' => '08124719231',
            'no_rm' => '08124719231'
        ]);

        DB::table('users')->insert([
            'name' => 'User 2',
            'email' => 'usertwo@example.com',
            'password' => Hash::make('user1234'),
            'status' => 3,
            'alamat' => 'Udinus',
            'no_ktp' => Str::random(12),
            'no_hp' => '08124712139',
            'no_rm' => '08124712139'
        ]);

        DB::table('obat')->insert([
            'nama_obat' => 'Anesthesia',
            'kemasan' => 'Plastik',
            'harga' => 300000
        ]);

        DB::table('obat')->insert([
            'nama_obat' => 'Anthrax',
            'kemasan' => 'Besi',
            'harga' => 600000
        ]);
    }
}
