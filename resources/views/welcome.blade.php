<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStudy AI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans">

    {{-- Navbar --}}
    <nav class="flex items-center justify-between px-10 py-4 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <svg class="w-8 h-8" viewBox="0 0 32 32" fill="none">
                <polygon points="16,2 28,9 28,23 16,30 4,23 4,9" fill="#111827"/>
                <path d="M10 16l4 4 8-8" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="font-bold text-gray-900 text-sm tracking-wide">SMARTSTUDY AI</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="/login" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Masuk</a>
            <a href="/register" class="text-sm bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition font-medium">Daftar</a>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="max-w-5xl mx-auto px-10 pt-20 pb-16">
        <div class="max-w-xl">
            <h1 class="text-5xl font-bold text-gray-900 leading-tight mb-4">
                Belajar Lebih <span class="text-emerald-500">Cerdas</span>,<br>
                Waktu Lebih <span class="text-orange-400">Teratur</span>.
            </h1>
            <p class="text-gray-500 text-base mb-8 leading-relaxed">
                SMARTSTUDY AI adalah workspace belajar modern yang membantu kamu mengelola tugas, mata kuliah, dan jadwal dengan lebih mudah dan terorganisir.
            </p>
            <div class="flex items-center gap-3">
                <a href="/register"
                   class="bg-gray-900 text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-gray-700 transition">
                    Mulai Sekarang
                </a>
                <a href="#fitur"
                   class="border border-gray-300 text-gray-700 px-6 py-3 rounded-xl font-semibold text-sm hover:bg-gray-50 transition">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    {{-- Feature Cards --}}
    <section id="fitur" class="max-w-5xl mx-auto px-10 pb-20">
        <div class="grid grid-cols-3 gap-4">
            <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-md transition">
                <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">AI Assistant</h3>
                <p class="text-gray-500 text-sm">Rekomendasi pintar untuk belajarmu.</p>
            </div>

            <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-md transition">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Manajemen Terpadu</h3>
                <p class="text-gray-500 text-sm">Tugas, mata kuliah, dan jadwal dalam satu tempat.</p>
            </div>

            <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-md transition">
                <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Produktivitas Maksimal</h3>
                <p class="text-gray-500 text-sm">Fokus belajar lebih baik dengan insight AI.</p>
            </div>
        </div>
    </section>

</body>
</html>
