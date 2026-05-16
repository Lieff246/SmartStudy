<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;

class StudyTimeRecommender implements Agent
{
    use Promptable;

    public function instructions(): string
    {
        return 'Kamu adalah mentor produktivitas mahasiswa. Berdasarkan daftar tugas yang saya berikan, '
             . 'buatkan 1-2 paragraf rekomendasi waktu belajar hari ini. Mana yang harus dikerjakan duluan, '
             . 'dan beri peringatan jika beban belajarnya terlihat berlebihan. Bersikaplah suportif.';
    }
}
