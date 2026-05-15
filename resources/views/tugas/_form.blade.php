<div class="space-y-6">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Tugas</label>
        <input type="text" name="judul_tugas" value="{{ old('judul_tugas', $tugas->judul_tugas ?? '') }}" required
            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-100 transition" />
        @error('judul_tugas')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Mata Kuliah</label>
            <select name="mata_kuliah_id" required
                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-100 transition">
                <option value="">Pilih mata kuliah</option>
                @foreach($mataKuliah as $course)
                    <option value="{{ $course->id }}" {{ old('mata_kuliah_id', $tugas->mata_kuliah_id ?? '') == $course->id ? 'selected' : '' }}>{{ $course->nama_mk }}</option>
                @endforeach
            </select>
            @error('mata_kuliah_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Deadline</label>
            <input type="datetime-local" name="deadline" value="{{ old('deadline', isset($tugas) ? $tugas->deadline->format('Y-m-d\TH:i') : '') }}" required
                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-100 transition" />
            @error('deadline')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Prioritas</label>
            <select name="prioritas" required
                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-100 transition">
                <option value="HIGH" {{ old('prioritas', $tugas->prioritas ?? 'MEDIUM') == 'HIGH' ? 'selected' : '' }}>Tinggi</option>
                <option value="MEDIUM" {{ old('prioritas', $tugas->prioritas ?? 'MEDIUM') == 'MEDIUM' ? 'selected' : '' }}>Sedang</option>
                <option value="LOW" {{ old('prioritas', $tugas->prioritas ?? 'MEDIUM') == 'LOW' ? 'selected' : '' }}>Rendah</option>
            </select>
            @error('prioritas')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
            <select name="status" required
                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-100 transition">
                <option value="belum_dikerjakan" {{ old('status', $tugas->status ?? 'belum_dikerjakan') == 'belum_dikerjakan' ? 'selected' : '' }}>Belum Dikerjakan</option>
                <option value="sedang_dikerjakan" {{ old('status', $tugas->status ?? '') == 'sedang_dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                <option value="selesai" {{ old('status', $tugas->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
        <textarea name="deskripsi" rows="5"
            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-100 transition">{{ old('deskripsi', $tugas->deskripsi ?? '') }}</textarea>
        @error('deskripsi')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="flex flex-col gap-3 sm:flex-row sm:justify-between sm:items-center">
        <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 transition sm:w-auto">{{ $submitLabel }}</button>
        <a href="{{ route('tugas.index') }}" class="inline-flex w-full items-center justify-center rounded-2xl border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-600 hover:border-gray-400 transition sm:w-auto">Kembali</a>
    </div>
</div>
