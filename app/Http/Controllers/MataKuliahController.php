<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = auth()->user()
            ->mataKuliah()
            ->orderBy('nama_mk')
            ->paginate(12);

        return view('mata_kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        return view('mata_kuliah.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_mk'   => ['required', 'string', 'max:20'],
            'nama_mk'   => ['required', 'string', 'max:255'],
            'sks'       => ['required', 'integer', 'min:1', 'max:10'],
            'dosen'     => ['nullable', 'string', 'max:255'],
            'semester'  => ['required', 'string', 'max:20'],
        ]);

        $data['user_id'] = auth()->id();

        MataKuliah::create($data);

        return redirect()->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $mataKuliah)
    {
        $this->authorizeOwner($mataKuliah);

        return view('mata_kuliah.edit', compact('mataKuliah'));
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $this->authorizeOwner($mataKuliah);

        $data = $request->validate([
            'kode_mk'   => ['required', 'string', 'max:20'],
            'nama_mk'   => ['required', 'string', 'max:255'],
            'sks'       => ['required', 'integer', 'min:1', 'max:10'],
            'dosen'     => ['nullable', 'string', 'max:255'],
            'semester'  => ['required', 'string', 'max:20'],
        ]);

        $mataKuliah->update($data);

        return redirect()->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $this->authorizeOwner($mataKuliah);

        $mataKuliah->delete();

        return redirect()->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }

    protected function authorizeOwner(MataKuliah $mataKuliah)
    {
        abort_if($mataKuliah->user_id !== auth()->id(), 403);
    }
}
