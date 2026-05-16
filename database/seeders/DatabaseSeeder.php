<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun User
        $user = User::factory()->create([
            'name' => 'Alif',
            'email' => 'test@example.com',
            // password defaultnya adalah 'password'
        ]);

        // 2. Buat Data Mata Kuliah
        $mk = \App\Models\MataKuliah::create([
            'user_id' => $user->id,
            'kode_mk' => 'TIF101',
            'nama_mk' => 'Pemrogramman Web',
            'sks' => 3,
            'dosen' => 'Rasya Rahmat, M.Kom',
            'semester' => 'Semester 4',
        ]);

        // 3. Buat Data Tugas
        $tugas1 = \App\Models\Tugas::create([
            'user_id' => $user->id,
            'mata_kuliah_id' => $mk->id,
            'judul_tugas' => 'Tugas 1: HTML dan CSS',
            'deskripsi' => 'Buat Landing Page',
            'deadline' => now()->addDays(2), // Deadline 2 hari lagi
            'estimated_hours' => 2,
            'prioritas' => 'HIGH',
            'status' => 'belum_dikerjakan',
        ]);

        $tugas2 = \App\Models\Tugas::create([
            'user_id' => $user->id,
            'mata_kuliah_id' => $mk->id,
            'judul_tugas' => 'Tugas 2: JavaScript',
            'deskripsi' => 'Buat kalkulator sederhana menggunakan JavaScript.',
            'deadline' => now()->addDays(5),
            'estimated_hours' => 5,
            'prioritas' => 'MEDIUM',
            'status' => 'sedang_dikerjakan',
        ]);

        // 4. Buat Data Reminder (sebagai contoh notifikasi belum dibaca)
        \App\Models\Reminder::create([
            'user_id' => $user->id,
            'tugas_id' => $tugas1->id,
            'jenis_reminder' => 'deadline_mendekat',
            'pesan' => 'Hei! Tugas HTML dan CSS deadline-nya tinggal 2 hari lagi. Ayo segera kerjakan!',
            'is_read' => false,
            'dikirim_pada' => now()->subHours(1),
        ]);
    }

}
