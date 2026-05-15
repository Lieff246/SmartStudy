<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'user_id',
        'tugas_id',
        'jenis_reminder',
        'pesan',
        'is_read',
        'dikirim_pada',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'dikirim_pada' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
