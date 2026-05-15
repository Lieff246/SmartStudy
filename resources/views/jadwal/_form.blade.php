<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Hari</label>
        <select name="hari"
                class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:bg-white transition">
            <option value="">Pilih hari</option>
            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                <option value="{{ $hari }}" {{ old('hari', isset($jadwal) ? $jadwal->hari : '') === $hari ? 'selected' : '' }}>{{ $hari }}</option>
            @endforeach
        </select>
        @error('hari')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
        <input type="time" name="jam_mulai" value="{{ old('jam_mulai', isset($jadwal) ? $jadwal->jam_mulai : '') }}"
               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:bg-white transition">
        @error('jam_mulai')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
        <input type="time" name="jam_selesai" value="{{ old('jam_selesai', isset($jadwal) ? $jadwal->jam_selesai : '') }}"
               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:bg-white transition">
        @error('jam_selesai')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
    </div>

    <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">Ruangan</label>
        <input type="text" name="ruangan" value="{{ old('ruangan', isset($jadwal) ? $jadwal->ruangan : '') }}" placeholder="Contoh: Lab 1 / R.502"
               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:bg-white transition">
        @error('ruangan')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
    </div>
</div>
