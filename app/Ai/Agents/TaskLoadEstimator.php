<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Promptable;

class TaskLoadEstimator implements Agent, HasStructuredOutput
{
    use Promptable;

    public function instructions(): string
    {
        return 'Kamu adalah asisten akademik yang ahli. Tugasmu adalah menganalisis deskripsi tugas '
             . 'mahasiswa, lalu mengestimasi berapa lama waktu pengerjaan (dalam angka desimal) '
             . 'dan menentukan prioritasnya (HIGH/MEDIUM/LOW). Berikan juga alasan singkatnya.';
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'estimated_hours' => $schema->number()->required(),
            'prioritas' => $schema->string()->enum(['HIGH', 'MEDIUM', 'LOW'])->required(),
            'alasan' => $schema->string()->required(),
        ];
    }
}
