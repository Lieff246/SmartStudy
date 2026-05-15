<x-layouts.app>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-500 mt-1">Ringkasan tugas, deadline, dan rekomendasi AI untuk mendukung aktivitas belajarmu.</p>
        </div>
        <a href="{{ route('tugas.create') }}"
           class="inline-flex items-center justify-center rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
            + Tugas Baru
        </a>
    </div>

    <div class="space-y-6">
        <div class="grid gap-6 xl:grid-cols-4">
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Tugas</p>
                <div class="mt-4 flex items-center justify-between gap-4">
                    <p class="text-3xl font-semibold text-gray-900">{{ $totalTugas }}</p>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-gray-100 text-gray-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-500">Total tugas yang kamu miliki</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Deadline Dekat</p>
                <div class="mt-4 flex items-center justify-between gap-4">
                    <p class="text-3xl font-semibold text-gray-900">{{ $deadlineDekat }}</p>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-red-100 text-red-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l2 2"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-500">Deadline dalam 3 hari ke depan</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Mata Kuliah</p>
                <div class="mt-4 flex items-center justify-between gap-4">
                    <p class="text-3xl font-semibold text-gray-900">{{ $mataKuliahCount }}</p>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-green-100 text-green-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h8m-8 6h16"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-500">Mata kuliah aktif</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Hari Ini</p>
                <div class="mt-4 flex items-center justify-between gap-4">
                    <p class="text-3xl font-semibold text-gray-900">{{ $tugasHariIni }}</p>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-500">Tugas dengan deadline hari ini</p>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[2fr_1fr]">
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-200">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">AI Insight</p>
                        <h2 class="mt-2 text-2xl font-semibold text-gray-900">Rekomendasi Prioritas</h2>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">Baru</span>
                </div>
                <p class="mt-6 text-sm leading-6 text-gray-600">{{ $aiInsight }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('tugas.index') }}" class="inline-flex items-center rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700 transition">Lihat Rekomendasi</a>
                    <a href="{{ route('tugas.create') }}" class="inline-flex items-center rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700 transition">Tambah Tugas</a>
                </div>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-200">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Overload Risk</p>
                        <h2 class="mt-2 text-2xl font-semibold text-gray-900">{{ $overloadRisk }}%</h2>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-orange-50 px-3 py-1 text-xs font-semibold text-orange-700">Sedang</span>
                </div>
                <div class="mt-6 h-3 overflow-hidden rounded-full bg-gray-100">
                    <div class="h-full rounded-full bg-gradient-to-r from-gray-900 to-gray-500" style="width: {{ $overloadRisk }}%"></div>
                </div>
                <p class="mt-4 text-sm text-gray-600">Beban tugas mendekati batas jika banyak deadline mendesak.</p>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-200">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Tugas Terdekat</h2>
                    <p class="text-sm text-gray-500 mt-1">Tugas dengan deadline paling dekat</p>
                </div>
                <a href="{{ route('tugas.index') }}" class="rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700 transition">Lihat Semua</a>
            </div>

            @if($upcoming->isEmpty())
                <div class="mt-6 rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-6 text-center text-sm text-gray-500">
                    Tidak ada tugas mendekati deadline saat ini.
                </div>
            @else
                <div class="mt-6 grid gap-4 lg:grid-cols-2">
                    @foreach($upcoming as $task)
                        <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4 hover:border-gray-300 transition">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1">
                                    <p class="text-xs font-semibold text-gray-500">{{ $task->mataKuliah->nama_mk ?? 'Mata Kuliah' }}</p>
                                    <h3 class="mt-1 text-sm font-semibold text-gray-900">{{ $task->judul_tugas }}</h3>
                                    <p class="mt-2 text-xs text-gray-600 line-clamp-2">{{ $task->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-xs text-gray-500">Deadline</p>
                                    <p class="mt-1 text-sm font-semibold text-gray-900">{{ $task->deadline->format('d M') }}</p>
                                </div>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <span class="rounded-full bg-amber-50 px-2 py-1 text-xs font-semibold text-amber-700">{{ $task->prioritas }}</span>
                                <span class="rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
