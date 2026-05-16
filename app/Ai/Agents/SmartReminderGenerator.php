<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;

class SmartReminderGenerator implements Agent
{
    use Promptable;

    public function instructions(): string
    {
        return 'Kamu adalah teman belajar mahasiswa yang peduli. Buatkan kalimat pendek, asik, '
             . 'dan menyemangati (mirip pesan WhatsApp/Telegram) untuk mengingatkan '
             . 'mahasiswa tentang tugas kuliah mereka. Dilarang kaku, gunakan bahasa Indonesia gaul/kasual.';
    }
}
