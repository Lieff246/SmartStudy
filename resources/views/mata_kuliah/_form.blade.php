<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Mata Kuliah</label>
        <input type="text" name="kode_mk" value="{{ old('kode_mk', isset($mataKuliah) ? $mataKuliah->kode_mk : '') }}" placeholder="CONTOH101"
               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:bg-white transition">
        @error('kode_mk')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
        <input type="text" name="semester" value="{{ old('semester', isset($mataKuliah) ? $mataKuliah->semester : '') }}" placeholder="Semester 1"
               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:bg-white transition">
        @error('semester')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
    </div>

    <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Mata Kuliah</label>
        <input type="text" name="nama_mk" value="{{ old('nama_mk', isset($mataKuliah) ? $mataKuliah->nama_mk : '') }}" placeholder="Contoh: Struktur Data dan Algoritma"
               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:bg-white transition">
        @error('nama_mk')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">SKS</label>
        <input type="number" name="sks" value="{{ old('sks', isset($mataKuliah) ? $mataKuliah->sks : '') }}" min="1" max="10"
               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:bg-white transition">
        @error('sks')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Dosen</label>
        <input type="text" name="dosen" value="{{ old('dosen', isset($mataKuliah) ? $mataKuliah->dosen : '') }}" placeholder="Nama dosen"
               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:bg-white transition">
        @error('dosen')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
    </div>
</div>
