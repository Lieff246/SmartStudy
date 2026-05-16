<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tugas;
use App\Models\Reminder;
use App\Ai\Agents\SmartReminderGenerator;

class SendReminders extends Command
{
    protected $signature = 'reminder:send';
    protected $description = 'Kirim reminder cerdas pakai Gemini AI';

    public function handle()
    {
        // 1. Cari tugas yang deadlinenya besok atau lusa
        $tugasMendekat = Tugas::whereBetween('deadline', [now(), now()->addDays(3)])
                           ->where('status', '!=', 'selesai')
                           ->get();

        $agent = new SmartReminderGenerator();

        foreach ($tugasMendekat as $tugas) {
            // 2. Minta AI buatin kata-kata penyemangat
            $prompt = "Tugas: {$tugas->judul_tugas}, Matkul: {$tugas->mataKuliah->nama_mk}, Deadline: {$tugas->deadline->diffForHumans()}";
            $pesan = (string) $agent->prompt($prompt);

            // 3. Simpan ke tabel reminders di database
            Reminder::create([
                'user_id' => $tugas->user_id,
                'tugas_id' => $tugas->id,
                'jenis_reminder' => 'deadline_mendekat',
                'pesan' => $pesan,
                'is_read' => false,
                'dikirim_pada' => now()
            ]);
            
            $this->info("Reminder terkirim untuk: {$tugas->judul_tugas}");
        }
    }
}
