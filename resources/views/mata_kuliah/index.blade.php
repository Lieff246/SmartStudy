<x-layouts.app>
    <x-slot:title>Mata Kuliah</x-slot:title>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Mata Kuliah</h1>
            <p class="text-gray-500 mt-1">Kelola data mata kuliah yang akan digunakan untuk tugas dan jadwal.</p>
        </div>
        <a href="{{ route('mata-kuliah.create') }}"
           class="inline-flex items-center justify-center rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
            Tambah Mata Kuliah
        </a>
    </div>

    <div class="grid gap-4">
        @forelse($mataKuliah as $mk)
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                            <span class="inline-flex items-center rounded-full bg-slate-100 px-2 py-1">{{ $mk->semester }}</span>
                            <span class="inline-flex items-center rounded-full bg-slate-100 px-2 py-1">{{ $mk->sks }} SKS</span>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">{{ $mk->nama_mk }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Kode: {{ $mk->kode_mk }} • Dosen: {{ $mk->dosen ?? 'Belum diisi' }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('mata-kuliah.edit', $mk) }}"
                           class="rounded-2xl border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-600 hover:border-gray-400 hover:text-gray-900 transition">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('mata-kuliah.destroy', $mk) }}" onsubmit="return confirm('Hapus mata kuliah ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded-2xl bg-red-500 px-4 py-2 text-sm font-semibold text-white hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-dashed border-gray-300 text-center">
                <p class="text-gray-500">Belum ada mata kuliah. Tambahkan mata kuliah terlebih dahulu.</p>
                <a href="{{ route('mata-kuliah.create') }}"
                   class="mt-4 inline-flex items-center justify-center rounded-2xl bg-gray-900 px-5 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
                    Tambah Mata Kuliah
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $mataKuliah->links() }}
    </div>
</x-layouts.app>
