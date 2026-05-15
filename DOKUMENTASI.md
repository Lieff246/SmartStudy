# 📚 SmartStudy — Dokumentasi Project

## 📖 Apa itu SmartStudy?

**SmartStudy** adalah aplikasi web manajemen tugas mahasiswa berbasis **Laravel 13** yang dilengkapi dengan **kecerdasan buatan (AI)**. Aplikasi ini dirancang khusus untuk membantu mahasiswa mengelola tugas perkuliahan, jadwal kuliah, dan waktu belajar secara lebih efektif dan terorganisir.

Berbeda dengan to-do list biasa, SmartStudy memiliki kemampuan **AI-powered** yang dapat:
- **Mengestimasi** berapa lama waktu yang dibutuhkan untuk mengerjakan sebuah tugas
- **Menentukan prioritas** tugas secara otomatis (HIGH / MEDIUM / LOW)
- **Mengirim reminder cerdas** dengan pesan yang ramah dan kontekstual
- **Menganalisis beban belajar** dan memberi peringatan jika terlalu berat

---

## 🎯 Latar Belakang & Masalah

Sebagai mahasiswa, sering kali kita menghadapi masalah seperti:

| Masalah | Dampak |
|---------|--------|
| Lupa deadline tugas | Nilai berkurang karena telat mengumpulkan |
| Tidak tahu harus mulai dari tugas mana | Waktu terbuang karena bingung prioritas |
| Salah estimasi waktu pengerjaan | Begadang di malam terakhir sebelum deadline |
| Jadwal kuliah bentrok | Salah masuk kelas atau melewatkan kelas |
| Tidak sadar beban tugas terlalu berat | Stres berlebihan di minggu-minggu tertentu |

**SmartStudy** hadir sebagai solusi dengan menggabungkan **manajemen tugas tradisional** dan **AI modern** untuk memberi mahasiswa kontrol penuh atas kehidupan akademiknya.

---

## 👤 Target Pengguna

- **Role:** Mahasiswa (hanya 1 role)
- **Akses:** Register mandiri (siapa saja bisa daftar)
- **Skenario:** Mahasiswa aktif yang ingin mengelola tugas dan jadwal perkuliahannya secara digital

---

## ✨ Fitur Utama

### 1. 🔐 Autentikasi (Login & Register)
- Mahasiswa bisa mendaftar akun baru dengan nama, email, dan password
- Login menggunakan email dan password
- Setelah login, diarahkan ke halaman Dashboard
- Logout untuk keluar dari akun
- Middleware memastikan hanya user yang sudah login bisa mengakses fitur

### 2. 📊 Dashboard
Halaman utama setelah login yang menampilkan ringkasan lengkap:

- **Statistik Tugas** — Total tugas, tugas belum dikerjakan, sedang dikerjakan, selesai, dan terlambat
- **Jadwal Hari Ini** — Daftar jadwal kuliah untuk hari ini beserta jam dan ruangan
- **Reminder** — Notifikasi cerdas dari AI tentang tugas yang deadline-nya mendekat
- **Analisis Beban** — Peringatan jika total estimasi jam pengerjaan minggu ini terlalu berat
- **Rekomendasi AI** — Saran waktu belajar dari AI berdasarkan semua tugas aktif

### 3. 📘 CRUD Mata Kuliah
Mahasiswa bisa mengelola daftar mata kuliah yang diambil:

| Aksi | Deskripsi |
|------|-----------|
| **Tambah** | Input kode MK, nama MK, jumlah SKS, nama dosen, semester |
| **Lihat** | Daftar semua mata kuliah yang sudah ditambahkan |
| **Edit** | Ubah informasi mata kuliah |
| **Hapus** | Hapus mata kuliah (jadwal dan tugas terkait ikut terhapus) |

### 4. 📅 CRUD Jadwal Kuliah
Setiap mata kuliah bisa memiliki beberapa jadwal (misal: kelas teori dan praktikum):

| Aksi | Deskripsi |
|------|-----------|
| **Tambah** | Input hari, jam mulai, jam selesai, ruangan |
| **Lihat** | Daftar jadwal untuk mata kuliah tertentu |
| **Edit** | Ubah informasi jadwal |
| **Hapus** | Hapus jadwal |

**Fitur khusus: Cek Konflik Jadwal**
Saat menambah jadwal baru, sistem otomatis mengecek apakah ada jadwal lain milik user yang sama di hari dan jam yang bertabrakan. Jika bentrok, akan muncul peringatan dan jadwal tidak bisa disimpan.

### 5. 📝 CRUD Tugas + Integrasi AI
Fitur utama SmartStudy — mengelola tugas dengan bantuan AI:

| Aksi | Deskripsi |
|------|-----------|
| **Tambah** | Input judul, deskripsi, mata kuliah terkait, deadline, status |
| **AI Estimasi** | AI otomatis mengestimasi waktu pengerjaan dan menentukan prioritas |
| **Lihat** | Daftar semua tugas dengan filter status dan prioritas |
| **Detail** | Lihat detail lengkap tugas beserta estimasi AI dan reminder |
| **Edit** | Ubah informasi tugas, bisa re-estimasi dengan AI |
| **Hapus** | Hapus tugas |

**Cara kerja AI di Tugas:**
1. Mahasiswa mengisi deskripsi tugas (misal: "Buat program sorting dengan Python")
2. AI membaca deskripsi + SKS mata kuliah + jarak ke deadline
3. AI mengembalikan:
   - `estimated_hours` → Estimasi jam pengerjaan (misal: 5 jam)
   - `prioritas` → HIGH / MEDIUM / LOW
   - `alasan` → Penjelasan mengapa prioritas tersebut

### 6. 🔔 Reminder Cerdas
Sistem reminder berbasis AI yang mengirim notifikasi ke dashboard:

| Jenis Reminder | Kapan Dikirim |
|----------------|---------------|
| `deadline_mendekat` | Tugas yang deadline-nya H-1 (besok) |
| `deadline_hari_ini` | Tugas yang deadline-nya hari ini |
| `tugas_terlambat` | Tugas yang sudah melewati deadline tapi belum selesai |
| `beban_berat` | Total estimasi jam minggu ini melebihi batas wajar |

Pesan reminder di-generate oleh AI sehingga terasa **ramah dan personal**, bukan notifikasi kaku. Contoh:
> "Hai! Tugas Algoritma deadline-nya besok lho 📚 Estimasi pengerjaannya sekitar 3 jam. Yuk mulai sekarang supaya nggak begadang!"

---

## 🤖 AI Agents

SmartStudy menggunakan 3 AI Agent yang masing-masing punya tugas spesifik:

### Agent 1: TaskLoadEstimator
- **Fungsi:** Mengestimasi waktu pengerjaan dan menentukan prioritas tugas
- **Dipanggil di:** `TugasController` saat membuat/edit tugas
- **Input:** Deskripsi tugas, SKS mata kuliah, deadline
- **Output:** `estimated_hours`, `prioritas` (HIGH/MEDIUM/LOW), `alasan`
- **Tipe:** Structured Output (JSON)

### Agent 2: SmartReminderGenerator
- **Fungsi:** Membuat pesan reminder yang ramah dan kontekstual
- **Dipanggil di:** Scheduler (otomatis setiap 08:00 & 20:00)
- **Input:** Data tugas + jarak ke deadline
- **Output:** Pesan reminder dalam bahasa Indonesia yang friendly
- **Tipe:** Text Output

### Agent 3: StudyTimeRecommender
- **Fungsi:** Memberikan rekomendasi dan saran waktu belajar
- **Dipanggil di:** `DashboardController` saat membuka dashboard
- **Input:** Semua tugas aktif milik user
- **Output:** Rekomendasi prioritas belajar dan waktu ideal
- **Tipe:** Text Output

---

## 🔐 Keamanan & Otorisasi

- **Middleware `auth`** — Semua halaman (kecuali login/register) hanya bisa diakses setelah login
- **Middleware `guest`** — Halaman login/register hanya bisa diakses jika belum login
- **Gate Authorization** — User hanya bisa melihat, edit, dan hapus data miliknya sendiri. Didefinisikan di `AppServiceProvider.php`
- **Atribut `role`** — Kolom role di tabel users untuk membatasi hak akses (default: `mahasiswa`)

---

## 📐 Arsitektur Aplikasi

```
┌─────────────────────────────────────────────────┐
│                   BROWSER                        │
│          (Mahasiswa mengakses web)                │
└────────────────────┬────────────────────────────┘
                     │ HTTP Request
                     ▼
┌─────────────────────────────────────────────────┐
│              ROUTES (web.php)                    │
│    Middleware: auth / guest                       │
│    Resource routes + Nested routes               │
└────────────────────┬────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────┐
│             CONTROLLERS                          │
│  AuthController      │ DashboardController       │
│  MataKuliahController│ JadwalController          │
│  TugasController     │ ReminderController        │
└───────┬─────────────┬───────────────────────────┘
        │             │
        ▼             ▼
┌──────────────┐ ┌──────────────────────────────┐
│   MODELS     │ │      AI AGENTS               │
│  User        │ │  TaskLoadEstimator           │
│  MataKuliah  │ │  SmartReminderGenerator      │
│  Jadwal      │ │  StudyTimeRecommender        │
│  Tugas       │ │      (Gemini API)            │
│  Reminder    │ └──────────────────────────────┘
└──────┬───────┘
       │
       ▼
┌─────────────────────────────────────────────────┐
│              DATABASE (MySQL)                    │
│  users │ mata_kuliah │ jadwal │ tugas │ reminders│
└─────────────────────────────────────────────────┘
```

---

## 🔄 Alur Penggunaan (User Flow)

### Alur 1: Pertama Kali Pakai
```
Register → Login → Tambah Mata Kuliah → Tambah Jadwal → Tambah Tugas → Lihat Dashboard
```

### Alur 2: Sehari-hari
```
Login → Dashboard (lihat reminder & jadwal hari ini) → Kerjakan tugas → Update status tugas
```

### Alur 3: Tambah Tugas Baru
```
Klik "Tambah Tugas" → Isi form (judul, deskripsi, MK, deadline)
→ AI otomatis estimasi waktu & prioritas → Simpan tugas
```

### Alur 4: Cek Konflik Jadwal
```
Pilih Mata Kuliah → Tambah Jadwal → Isi hari & jam
→ Sistem cek konflik → Jika bentrok: tampilkan peringatan
→ Jika aman: jadwal tersimpan
```

---

## 📚 Modul Pembelajaran yang Diimplementasikan

| Modul | Topik | Implementasi di SmartStudy |
|-------|-------|---------------------------|
| **Modul 3** | Routing, Controller, Parameter, Nested Route | Route resource, nested route jadwal di bawah mata kuliah, route parameter |
| **Modul 4** | Blade Templating, Integrasi Frontend | Layout `app.blade.php`, component, `@extends`, `@section`, `@foreach`, `@if` |
| **Modul 5** | Integrasi Database, CRUD, Migration, Seeder | 5 migration, 5 model dengan relasi, 4 seeder, CRUD lengkap |
| **Modul 6** | Autentikasi, Middleware, Gate | AuthController, middleware auth/guest, Gate di AppServiceProvider |
| **Modul 7** | Laravel AI SDK, Agent, Structured Output | 3 AI Agent, HasStructuredOutput, Gemini API |
