<x-layouts.app>
    <x-slot:title>Tambah Tugas</x-slot:title>

    <div class="mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
        <div class="mb-6">
            <p class="text-sm font-semibold text-slate-500">Tambah Tugas Baru</p>
            <h1 class="mt-2 text-2xl font-semibold text-slate-900">Buat tugas untuk mata kuliahmu</h1>
        </div>

        @if($mataKuliah->isEmpty())
            <div class="rounded-3xl border border-orange-200 bg-orange-50 p-6 text-orange-700">
                Kamu belum memiliki mata kuliah. Silakan tambahkan mata kuliah terlebih dahulu sebelum membuat tugas.
            </div>
        @else
            <form method="POST" action="{{ route('tugas.store') }}">
                @csrf
                @include('tugas._form', ['submitLabel' => 'Simpan Tugas'])
            </form>
        @endif
    </div>
</x-layouts.app>
