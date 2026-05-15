<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function indexAll()
    {
        $mataKuliah = auth()->user()
            ->mataKuliah()
            ->with(['jadwals' => function ($query) {
                $query->orderBy('hari')->orderBy('jam_mulai');
            }])
            ->orderBy('nama_mk')
            ->get();

        return view('jadwal.index', compact('mataKuliah'));
    }

    public function index(MataKuliah $mataKuliah)
    {
        $this->authorizeOwner($mataKuliah);

        $jadwals = $mataKuliah->jadwals()->orderBy('hari')->orderBy('jam_mulai')->get();

        return view('jadwal.index', compact('mataKuliah', 'jadwals'));
    }

    public function create(MataKuliah $mataKuliah)
    {
        $this->authorizeOwner($mataKuliah);

        return view('jadwal.create', compact('mataKuliah'));
    }

    public function store(Request $request, MataKuliah $mataKuliah)
    {
        $this->authorizeOwner($mataKuliah);

        $data = $this->validateJadwal($request);
        $data['mata_kuliah_id'] = $mataKuliah->id;

        if ($this->hasConflict($data)) {
            return back()->withInput()
                ->withErrors(['jam_mulai' => 'Jadwal bertabrakan dengan jadwal lain di hari yang sama.']);
        }

        Jadwal::create($data);

        return redirect()->route('mata-kuliah.jadwal.index', $mataKuliah)
            ->with('success', 'Jadwal berhasil disimpan.');
    }

    public function edit(MataKuliah $mataKuliah, Jadwal $jadwal)
    {
        $this->authorizeOwner($mataKuliah);
        abort_if($jadwal->mata_kuliah_id !== $mataKuliah->id, 404);

        return view('jadwal.edit', compact('mataKuliah', 'jadwal'));
    }

    public function update(Request $request, MataKuliah $mataKuliah, Jadwal $jadwal)
    {
        $this->authorizeOwner($mataKuliah);
        abort_if($jadwal->mata_kuliah_id !== $mataKuliah->id, 404);

        $data = $this->validateJadwal($request);

        if ($this->hasConflict($data, $jadwal->id)) {
            return back()->withInput()
                ->withErrors(['jam_mulai' => 'Jadwal bertabrakan dengan jadwal lain di hari yang sama.']);
        }

        $jadwal->update($data);

        return redirect()->route('mata-kuliah.jadwal.index', $mataKuliah)
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah, Jadwal $jadwal)
    {
        $this->authorizeOwner($mataKuliah);
        abort_if($jadwal->mata_kuliah_id !== $mataKuliah->id, 404);

        $jadwal->delete();

        return redirect()->route('mata-kuliah.jadwal.index', $mataKuliah)
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    protected function validateJadwal(Request $request)
    {
        return $request->validate([
            'hari'        => ['required', 'string', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu'],
            'jam_mulai'   => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'ruangan'     => ['nullable', 'string', 'max:255'],
        ]);
    }

    protected function hasConflict(array $data, ?int $excludeId = null): bool
    {
        $conflict = Jadwal::whereHas('mataKuliah', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->where('hari', $data['hari'])
        ->when($excludeId, function ($query) use ($excludeId) {
            $query->where('id', '!=', $excludeId);
        })
        ->where('jam_mulai', '<', $data['jam_selesai'])
        ->where('jam_selesai', '>', $data['jam_mulai'])
        ->exists();

        return $conflict;
    }

    protected function authorizeOwner(MataKuliah $mataKuliah)
    {
        abort_if($mataKuliah->user_id !== auth()->id(), 403);
    }
}
