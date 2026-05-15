<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tugas_id')->constrained('tugas')->cascadeOnDelete();
            $table->enum('jenis_reminder', ['deadline_mendekat', 'deadline_hari_ini', 'tugas_terlambat', 'beban_berat']);
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamp('dikirim_pada')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
