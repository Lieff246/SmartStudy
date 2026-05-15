<x-layouts.app>
    <x-slot:title>Jadwal</x-slot:title>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Jadwal Kuliah</h1>
            <p class="text-gray-500 mt-1">Lihat dan kelola jadwal kuliah untuk setiap mata kuliah.</p>
        </div>
        @if(isset($mataKuliah) && $mataKuliah instanceof \Illuminate\Database\Eloquent\Collection)
            <a href="{{ $mataKuliah->first() ? route('mata-kuliah.jadwal.create', $mataKuliah->first()) : route('mata-kuliah.index') }}"
               class="inline-flex items-center justify-center rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
                Tambah Jadwal
            </a>
        @endif
    </div>

    @if(isset($jadwals))
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-200">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">{{ $mataKuliah->nama_mk }}</h2>
                    <p class="text-sm text-gray-500">Kode {{ $mataKuliah->kode_mk }} • {{ $mataKuliah->semester }} • {{ $mataKuliah->sks }} SKS</p>
                </div>
                <a href="{{ route('mata-kuliah.jadwal.create', $mataKuliah) }}"
                   class="rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700 transition">
                    Tambah Jadwal Baru
                </a>
            </div>

            @if($jadwals->count())
                <div class="mt-6 overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="border-b border-gray-200 text-gray-500">
                            <tr>
                                <th class="py-3 pr-6">Hari</th>
                                <th class="py-3 pr-6">Jam</th>
                                <th class="py-3 pr-6">Ruangan</th>
                                <th class="py-3 pr-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($jadwals as $jadwal)
                                <tr class="hover:bg-slate-50">
                                    <td class="py-4 pr-6 font-medium text-gray-900">{{ $jadwal->hari }}</td>
                                    <td class="py-4 pr-6">{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</td>
                                    <td class="py-4 pr-6">{{ $jadwal->ruangan ?? '—' }}</td>
                                    <td class="py-4 pr-6 space-x-2">
                                        <a href="{{ route('mata-kuliah.jadwal.edit', [$mataKuliah, $jadwal]) }}"
                                           class="rounded-2xl border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-600 hover:border-gray-400 transition">Edit</a>
                                        <form method="POST" action="{{ route('mata-kuliah.jadwal.destroy', [$mataKuliah, $jadwal]) }}" class="inline-block" onsubmit="return confirm('Hapus jadwal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-2xl bg-red-500 px-3 py-2 text-xs font-semibold text-white hover:bg-red-600 transition">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-6 rounded-3xl border border-dashed border-gray-200 bg-slate-50 p-6 text-center text-sm text-gray-500">
                    Belum ada jadwal untuk mata kuliah ini. Tambahkan jadwal untuk mulai mengatur kelas.
                </div>
            @endif
        </div>
    @else
        @if($mataKuliah->count())
            <div class="grid gap-4">
                @foreach($mataKuliah as $mk)
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-200">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">{{ $mk->nama_mk }}</h2>
                                <p class="text-sm text-gray-500">{{ $mk->kode_mk }} • {{ $mk->semester }} • {{ $mk->sks }} SKS</p>
                            </div>

                            <a href="{{ route('mata-kuliah.jadwal.create', $mk) }}"
                               class="rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700 transition">
                                Tambah Jadwal
                            </a>
                        </div>

                        @if($mk->jadwals->count())
                            <div class="mt-5 overflow-x-auto">
                                <table class="w-full text-left text-sm text-gray-600">
                                    <thead class="border-b border-gray-200 text-gray-500">
                                        <tr>
                                            <th class="py-3 pr-6">Hari</th>
                                            <th class="py-3 pr-6">Jam</th>
                                            <th class="py-3 pr-6">Ruangan</th>
                                            <th class="py-3 pr-6">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($mk->jadwals as $jadwal)
                                            <tr class="hover:bg-slate-50">
                                                <td class="py-4 pr-6 font-medium text-gray-900">{{ $jadwal->hari }}</td>
                                                <td class="py-4 pr-6">{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</td>
                                                <td class="py-4 pr-6">{{ $jadwal->ruangan ?? '—' }}</td>
                                                <td class="py-4 pr-6 space-x-2">
                                                    <a href="{{ route('mata-kuliah.jadwal.edit', [$mk, $jadwal]) }}"
                                                       class="rounded-2xl border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-600 hover:border-gray-400 transition">Edit</a>
                                                    <form method="POST" action="{{ route('mata-kuliah.jadwal.destroy', [$mk, $jadwal]) }}" class="inline-block" onsubmit="return confirm('Hapus jadwal ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="rounded-2xl bg-red-500 px-3 py-2 text-xs font-semibold text-white hover:bg-red-600 transition">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="mt-5 rounded-3xl border border-dashed border-gray-200 bg-slate-50 p-6 text-sm text-gray-500">
                                Belum ada jadwal untuk mata kuliah ini.
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-dashed border-gray-300 text-center">
                <p class="text-gray-500">Belum ada mata kuliah. Tambahkan mata kuliah terlebih dahulu untuk mulai membuat jadwal.</p>
                <a href="{{ route('mata-kuliah.index') }}"
                   class="mt-4 inline-flex items-center justify-center rounded-2xl bg-gray-900 px-5 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
                    Tambah Mata Kuliah
                </a>
            </div>
        @endif
    @endif
</x-layouts.app>
