<?php

namespace App\Models;

use App\Models\MataKuliah;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = [
        'user_id',
        'mata_kuliah_id',
        'judul_tugas',
        'deskripsi',
        'deadline',
        'estimated_hours',
        'prioritas',
        'status',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'estimated_hours' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
