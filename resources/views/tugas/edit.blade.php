<x-layouts.app>
    <x-slot:title>Edit Tugas</x-slot:title>

    <div class="mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
        <div class="mb-6">
            <p class="text-sm font-semibold text-slate-500">Edit Tugas</p>
            <h1 class="mt-2 text-2xl font-semibold text-slate-900">Perbarui detail tugas</h1>
        </div>

        <form method="POST" action="{{ route('tugas.update', $tugas) }}">
            @csrf
            @method('PUT')
            @include('tugas._form', ['submitLabel' => 'Perbarui Tugas'])
        </form>
    </div>
</x-layouts.app>
