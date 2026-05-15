<x-layouts.app>
    <x-slot:title>Tugas</x-slot:title>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tugas</h1>
            <p class="text-gray-500 mt-1">Kelola tugas untuk setiap mata kuliah dengan deadline dan prioritas.</p>
        </div>
        <a href="{{ route('tugas.create') }}"
           class="inline-flex items-center justify-center rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
            + Tugas Baru
        </a>
    </div>

    <div class="space-y-6">

        @if(session('success'))
            <div class="rounded-3xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif


        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-200">
            <div class="grid gap-4 lg:grid-cols-[minmax(0,1.5fr)_1fr_1fr_auto] items-end">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Cari tugas</label>
                    <input type="text" name="search" value="{{ request('search') }}" form="tugas-filter" placeholder="Cari judul atau deskripsi"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-100 transition" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Status</label>
                    <select name="status" form="tugas-filter"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-100 transition">
                        <option value="">Semua Status</option>
                        <option value="belum_dikerjakan" {{ request('status') == 'belum_dikerjakan' ? 'selected' : '' }}>Belum Dikerjakan</option>
                        <option value="sedang_dikerjakan" {{ request('status') == 'sedang_dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Mata Kuliah</label>
                    <select name="mata_kuliah_id" form="tugas-filter"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-100 transition">
                        <option value="">Semua Mata Kuliah</option>
                        @foreach($mataKuliah as $course)
                            <option value="{{ $course->id }}" {{ request('mata_kuliah_id') == $course->id ? 'selected' : '' }}>{{ $course->nama_mk }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" form="tugas-filter" class="inline-flex items-center justify-center rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700 transition">Filter</button>
                </div>
            </div>
        </div>
        <form id="tugas-filter" action="{{ route('tugas.index') }}" method="GET"></form>
        @if($tugas->isEmpty())
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-dashed border-gray-300 text-center">
                <p class="text-gray-500">Belum ada tugas. Tambahkan tugas baru untuk mulai mengatur kegiatan belajarmu.</p>
                <a href="{{ route('tugas.create') }}"
                   class="mt-4 inline-flex items-center justify-center rounded-2xl bg-gray-900 px-5 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
                    + Tambah Tugas
                </a>
            </div>
        @else
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="border-b border-gray-200 text-gray-500">
                            <tr>
                                <th class="py-3 pr-6">Judul</th>
                                <th class="py-3 pr-6">Mata Kuliah</th>
                                <th class="py-3 pr-6">Deadline</th>
                                <th class="py-3 pr-6">Prioritas</th>
                                <th class="py-3 pr-6">Status</th>
                                <th class="py-3 pr-6">Estimasi</th>
                                <th class="py-3 pr-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($tugas as $task)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 pr-6 font-medium text-gray-900">{{ $task->judul_tugas }}</td>
                                    <td class="py-4 pr-6">{{ $task->mataKuliah->nama_mk ?? '-' }}</td>
                                    <td class="py-4 pr-6">{{ $task->deadline->format('d M Y H:i') }}</td>
                                    <td class="py-4 pr-6">{{ $task->prioritas }}</td>
                                    <td class="py-4 pr-6">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                                    <td class="py-4 pr-6">{{ $task->estimated_hours ? $task->estimated_hours.' jam' : 'Belum' }}</td>
                                    <td class="py-4 pr-6 space-x-2">
                                        <a href="{{ route('tugas.show', $task) }}"
                                           class="rounded-2xl border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-600 hover:border-gray-400 transition">Lihat</a>
                                        <a href="{{ route('tugas.edit', $task) }}"
                                           class="rounded-2xl border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-600 hover:border-gray-400 transition">Edit</a>
                                        <form action="{{ route('tugas.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus tugas ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-2xl bg-red-500 px-3 py-2 text-xs font-semibold text-white hover:bg-red-600 transition">Hapus</button>
                                        </form>
                                        <form action="{{ route('tugas.estimate', $task) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="rounded-2xl border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-600 hover:border-gray-400 transition">Estimasi AI</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
