<?php

namespace App\Providers;

use App\Models\MataKuliah;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('manage-matakuliah', function (User $user, MataKuliah $mk) {
            return $user->id === $mk->user_id;
        });

        Gate::define('manage-tugas', function (User $user, Tugas $tugas) {
            return $user->id === $tugas->user_id;
        });

        Gate::define('mahasiswa', function (User $user) {
            return $user->role === 'mahasiswa';
        });
    }
}
