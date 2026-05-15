<x-layouts.app>
    <x-slot:title>Edit Jadwal</x-slot:title>

    <div class="max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Jadwal</h1>
            <p class="text-gray-500 mt-1">Perbarui jadwal untuk mata kuliah <strong>{{ $mataKuliah->nama_mk }}</strong>.</p>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-200">
            <form action="{{ route('mata-kuliah.jadwal.update', [$mataKuliah, $jadwal]) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                @include('jadwal._form')

                <div class="flex items-center gap-3">
                    <a href="{{ route('mata-kuliah.jadwal.index', $mataKuliah) }}"
                       class="rounded-2xl border border-gray-300 bg-white px-5 py-2 text-sm font-medium text-gray-600 hover:border-gray-400 transition">
                        Kembali
                    </a>
                    <button type="submit"
                        class="rounded-2xl bg-gray-900 px-5 py-2 text-sm font-semibold text-white hover:bg-gray-700 transition">
                        Perbarui Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
