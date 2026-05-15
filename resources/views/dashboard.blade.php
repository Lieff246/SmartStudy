<x-layouts.app>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="bg-white rounded-2xl p-8 shadow-sm">
        <h1 class="text-2xl font-bold text-gray-900">Halo, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-gray-500 mt-1">Semangat belajar hari ini!</p>
    </div>
</x-layouts.app>
