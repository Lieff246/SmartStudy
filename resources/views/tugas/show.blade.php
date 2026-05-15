<x-layouts.app>
    <x-slot:title>Detail Tugas</x-slot:title>

    <div class="mx-auto max-w-3xl space-y-6">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Detail Tugas</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $tugas->judul_tugas }}</h1>
                    <p class="mt-2 text-sm text-slate-500">{{ $tugas->mataKuliah->nama_mk ?? 'Mata kuliah tidak tersedia' }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('tugas.edit', $tugas) }}" class="inline-flex items-center rounded-full bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-700 hover:bg-emerald-100 transition">Edit</a>
                    <form action="{{ route('tugas.estimate', $tugas) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="inline-flex items-center rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-100 transition">Estimasi AI</button>
                    </form>
                </div>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <p class="text-sm font-semibold text-slate-700">Deadline</p>
                    <p class="mt-3 text-xl font-semibold text-slate-900">{{ $tugas->deadline->format('d M Y H:i') }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <p class="text-sm font-semibold text-slate-700">Prioritas</p>
                    <p class="mt-3 text-xl font-semibold text-slate-900">{{ $tugas->prioritas }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <p class="text-sm font-semibold text-slate-700">Status</p>
                    <p class="mt-3 text-xl font-semibold text-slate-900">{{ ucfirst(str_replace('_', ' ', $tugas->status)) }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <p class="text-sm font-semibold text-slate-700">Estimasi</p>
                    <p class="mt-3 text-xl font-semibold text-slate-900">{{ $tugas->estimated_hours ? $tugas->estimated_hours.' jam' : 'Belum ada' }}</p>
                </div>
            </div>

            <div class="mt-8 rounded-3xl border border-slate-200 bg-white p-6">
                <p class="text-sm font-semibold text-slate-700">Deskripsi</p>
                <p class="mt-4 text-sm leading-7 text-slate-600">{{ $tugas->deskripsi ?: 'Tidak ada deskripsi tugas.' }}</p>
            </div>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('tugas.index') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">Kembali ke Tugas</a>
                <form action="{{ route('tugas.destroy', $tugas) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus tugas ini?')" class="inline-flex items-center rounded-full bg-red-50 px-5 py-3 text-sm font-semibold text-red-700 hover:bg-red-100 transition">Hapus Tugas</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
