# 📚 SmartStudy

Web manajemen tugas mahasiswa dengan kecerdasan buatan (AI) yang membantu mengestimasi waktu pengerjaan tugas, menentukan prioritas, mengirim reminder cerdas, dan memberi peringatan jika beban tugas terlalu berat.

## 🛠️ Tech Stack

- **Framework:** Laravel 13
- **PHP:** 8.3+
- **Database:** MySQL
- **AI:** Laravel AI SDK (laravel/ai) + Google Gemini API
- **Frontend:** Blade + Tailwind CSS 4
- **Build Tool:** Vite

## 📁 Struktur Folder Project

```
smartstudy/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php          # Login, Register, Logout
│   │       ├── DashboardController.php     # Halaman utama + ringkasan + AI rekomendasi
│   │       ├── MataKuliahController.php    # CRUD Mata Kuliah
│   │       ├── JadwalController.php        # CRUD Jadwal + cek konflik
│   │       ├── TugasController.php         # CRUD Tugas + AI estimasi & prioritas
│   │       └── ReminderController.php      # Mark reminder as read
│   ├── Ai/
│   │   └── Agents/
│   │       ├── TaskLoadEstimator.php        # AI Agent 1: estimasi jam & prioritas
│   │       ├── SmartReminderGenerator.php   # AI Agent 2: generate pesan reminder
│   │       └── StudyTimeRecommender.php     # AI Agent 3: rekomendasi waktu belajar
│   ├── Models/
│   │   ├── User.php                        # (sudah ada, tambah relasi + role)
│   │   ├── MataKuliah.php
│   │   ├── Jadwal.php
│   │   ├── Tugas.php
│   │   └── Reminder.php
│   └── Providers/
│       └── AppServiceProvider.php          # (sudah ada, tambah Gate di sini)
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_users_table.php           # (sudah ada)
│   │   ├── xxxx_add_role_to_users_table.php      # Tambah kolom role
│   │   ├── xxxx_create_mata_kuliah_table.php
│   │   ├── xxxx_create_jadwal_table.php
│   │   ├── xxxx_create_tugas_table.php
│   │   └── xxxx_create_reminders_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── MataKuliahSeeder.php
│       ├── JadwalSeeder.php
│       ├── TugasSeeder.php
│       └── ReminderSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php               # Layout utama (component default)
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── dashboard.blade.php
│       ├── mata-kuliah/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── jadwal/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       └── tugas/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
└── routes/
    ├── web.php                             # Semua route + middleware auth/guest
    └── console.php                         # Scheduler reminder
```

## ⚡ Command untuk Generate Semua File

### Modul 5: Model, Migration, Seeder
```bash
# Migration
php artisan make:migration create_mata_kuliah_table
php artisan make:migration create_jadwal_table
php artisan make:migration create_tugas_table
php artisan make:migration create_reminders_table
php artisan make:migration add_role_to_users_table

# Model
php artisan make:model MataKuliah
php artisan make:model Jadwal
php artisan make:model Tugas
php artisan make:model Reminder

# Seeder
php artisan make:seeder MataKuliahSeeder
php artisan make:seeder JadwalSeeder
php artisan make:seeder TugasSeeder
php artisan make:seeder ReminderSeeder
```

### Modul 4: Controller
```bash
php artisan make:controller AuthController
php artisan make:controller DashboardController
php artisan make:controller MataKuliahController --resource
php artisan make:controller JadwalController --resource
php artisan make:controller TugasController --resource
php artisan make:controller ReminderController
```

### Modul 7: AI (Laravel AI SDK + Gemini)
```bash
# Install Laravel AI SDK
composer require laravel/ai

# Publish konfigurasi AI
php artisan vendor:publish --provider="Laravel\Ai\AiServiceProvider"

# Buat 3 AI Agent
php artisan make:agent TaskLoadEstimator
php artisan make:agent SmartReminderGenerator
php artisan make:agent StudyTimeRecommender
```

Lalu tambahkan di `.env`:
```
GEMINI_API_KEY=your-gemini-api-key-here
```

Dan set provider default di `config/ai.php`:
```php
'default' => 'gemini',
```

### Jalankan Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
```

### Jalankan Aplikasi
```bash
php artisan serve     # Terminal 1
npm run dev           # Terminal 2
```

## 🗄️ Database Design (5 Tabel)

### Tabel `users` (bawaan Laravel + tambah role)
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| name | string | Nama user |
| email | string | Email (unique) |
| password | string | Password (hashed) |
| role | string (default: 'mahasiswa') | Role user |

### Tabel `mata_kuliah`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| user_id | FK → users | Pemilik data |
| kode_mk | string(20) | Kode mata kuliah |
| nama_mk | string | Nama mata kuliah |
| sks | integer | Jumlah SKS |
| dosen | string (nullable) | Nama dosen |
| semester | string(20) | Semester |

### Tabel `jadwal`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| mata_kuliah_id | FK → mata_kuliah | Mata kuliah terkait |
| hari | enum | Senin-Sabtu |
| jam_mulai | time | Jam mulai |
| jam_selesai | time | Jam selesai |
| ruangan | string (nullable) | Ruangan kelas |

### Tabel `tugas`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| user_id | FK → users | Pemilik tugas |
| mata_kuliah_id | FK → mata_kuliah | Mata kuliah terkait |
| judul_tugas | string | Judul tugas |
| deskripsi | text (nullable) | Deskripsi tugas |
| deadline | datetime | Batas waktu |
| estimated_hours | float (nullable) | Estimasi jam (dari AI) |
| prioritas | enum | HIGH / MEDIUM / LOW |
| status | enum | belum_dikerjakan / sedang_dikerjakan / selesai |

### Tabel `reminders`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| user_id | FK → users | Pemilik reminder |
| tugas_id | FK → tugas | Tugas terkait |
| jenis_reminder | enum | deadline_mendekat / deadline_hari_ini / tugas_terlambat / beban_berat |
| pesan | text | Pesan reminder (dari AI) |
| is_read | boolean | Sudah dibaca atau belum |
| dikirim_pada | timestamp | Waktu dikirim |

## 🔗 Relasi Antar Model

```
User ──hasMany──> MataKuliah ──hasMany──> Jadwal
  │                   │
  │                   └──hasMany──> Tugas ──hasOne──> Reminder
  │                                  │
  ├──hasMany──> Tugas ◄──────────────┘
  └──hasMany──> Reminder
```

## 🤖 AI Agents (Laravel AI SDK + Gemini)

Agent dibuat dengan `php artisan make:agent` dan disimpan di `app/Ai/Agents/`.
Dipanggil dari Controller menggunakan `(new AgentName)->prompt(...)`.

| Agent | File | Fungsi |
|-------|------|--------|
| TaskLoadEstimator | `app/Ai/Agents/TaskLoadEstimator.php` | Estimasi jam & prioritas dari deskripsi tugas |
| SmartReminderGenerator | `app/Ai/Agents/SmartReminderGenerator.php` | Generate pesan reminder friendly |
| StudyTimeRecommender | `app/Ai/Agents/StudyTimeRecommender.php` | Rekomendasi waktu belajar |

### Contoh Agent: TaskLoadEstimator
```php
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
        return 'Kamu adalah asisten akademik. Estimasi waktu pengerjaan tugas '
             . 'mahasiswa dalam jam dan tentukan prioritas (HIGH/MEDIUM/LOW).';
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
```

### Penggunaan di Controller
```php
use App\Ai\Agents\TaskLoadEstimator;

// Di TugasController@store
$agent = new TaskLoadEstimator();
$result = $agent->prompt(
    "Tugas: {$deskripsi}, SKS: {$sks}, Deadline: {$deadline}"
);

$data = $result->structured;
// $data['estimated_hours'] → 5
// $data['prioritas'] → "HIGH"
// $data['alasan'] → "Tugas ini kompleks karena..."
```

## 🛣️ Route Structure

```
# Auth (guest middleware)
GET    /login                              → AuthController@showLogin
POST   /login                              → AuthController@login
GET    /register                           → AuthController@showRegister
POST   /register                           → AuthController@register

# Protected (auth middleware)
POST   /logout                             → AuthController@logout
GET    /dashboard                          → DashboardController@index

# Mata Kuliah (resource)
GET    /mata-kuliah                        → MataKuliahController@index
GET    /mata-kuliah/create                 → MataKuliahController@create
POST   /mata-kuliah                        → MataKuliahController@store
GET    /mata-kuliah/{mataKuliah}           → MataKuliahController@show
GET    /mata-kuliah/{mataKuliah}/edit      → MataKuliahController@edit
PUT    /mata-kuliah/{mataKuliah}           → MataKuliahController@update
DELETE /mata-kuliah/{mataKuliah}           → MataKuliahController@destroy

# Jadwal (nested resource)
GET    /mata-kuliah/{mataKuliah}/jadwal            → JadwalController@index
GET    /mata-kuliah/{mataKuliah}/jadwal/create      → JadwalController@create
POST   /mata-kuliah/{mataKuliah}/jadwal             → JadwalController@store
GET    /mata-kuliah/{mataKuliah}/jadwal/{jadwal}/edit → JadwalController@edit
PUT    /mata-kuliah/{mataKuliah}/jadwal/{jadwal}     → JadwalController@update
DELETE /mata-kuliah/{mataKuliah}/jadwal/{jadwal}     → JadwalController@destroy

# Tugas (resource)
GET    /tugas                              → TugasController@index
GET    /tugas/create                       → TugasController@create
POST   /tugas                              → TugasController@store
GET    /tugas/{tugas}                      → TugasController@show
GET    /tugas/{tugas}/edit                 → TugasController@edit
PUT    /tugas/{tugas}                      → TugasController@update
DELETE /tugas/{tugas}                      → TugasController@destroy
POST   /tugas/{tugas}/estimate             → TugasController@aiEstimate

# Reminder
PATCH  /reminders/{reminder}/read          → ReminderController@markAsRead
```

## 🔐 Gate Authorization (di AppServiceProvider)

Gate didefinisikan di `app/Providers/AppServiceProvider.php` untuk membatasi hak akses:

```php
// di method boot()
Gate::define('manage-matakuliah', function (User $user, MataKuliah $mk) {
    return $user->id === $mk->user_id;
});

Gate::define('manage-tugas', function (User $user, Tugas $tugas) {
    return $user->id === $tugas->user_id;
});

Gate::define('mahasiswa', function (User $user) {
    return $user->role === 'mahasiswa';
});
```

Penggunaan di Controller:
```php
// Cek apakah user pemilik data
if (Gate::denies('manage-matakuliah', $mataKuliah)) {
    abort(403);
}
```

## 👥 Pembagian Tugas (5 Anggota)

| Anggota | Tugas | Modul |
|---------|-------|-------|
| 1 | Auth (Login/Register/Logout) + Layout Blade + Middleware + Gate | Modul 6 |
| 2 | CRUD Mata Kuliah + CRUD Jadwal + Cek Konflik | Modul 4-5 |
| 3 | CRUD Tugas + Integrasi AI di Form | Modul 4-5 + 7 |
| 4 | 3 AI Agent (langsung di Controller) + Reminder | Modul 7 |
| 5 | Dashboard + Seeder + Routing | Modul 3 + 5 |

## 📋 Setup Pertama Kali

```bash
git clone <repo-url>
cd smartstudy

composer install
npm install

cp .env.example .env
php artisan key:generate

# Set di .env: DB_DATABASE=smartstudy, GEMINI_API_KEY=xxx

php artisan migrate
php artisan db:seed

php artisan serve
npm run dev
```
