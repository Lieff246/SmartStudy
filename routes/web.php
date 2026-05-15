<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;

// Landing page (public)
Route::get('/', fn() => view('welcome'))->name('home');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Auth routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Mata Kuliah
    Route::resource('mata-kuliah', MataKuliahController::class);

    // Jadwal
    Route::get('/jadwal', [JadwalController::class, 'indexAll'])->name('jadwal.index');
    Route::resource('mata-kuliah.jadwal', JadwalController::class)->except(['show']);

    // Tugas
    Route::post('/tugas/{tugas}/estimate', [TugasController::class, 'aiEstimate'])->name('tugas.estimate');
    Route::resource('tugas', TugasController::class);

    // Reminder
    Route::patch('/reminders/{reminder}/read', [ReminderController::class, 'markAsRead'])->name('reminders.read');
});
