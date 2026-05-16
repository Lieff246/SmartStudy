<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->tugas()->with('mataKuliah');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('judul_tugas', 'like', '%'.$request->search.'%')
                    ->orWhere('deskripsi', 'like', '%'.$request->search.'%');
            });
        }

        $tugas = $query->orderBy('deadline')->get();
        $mataKuliah = auth()->user()->mataKuliah()->orderBy('nama_mk')->get();

        return view('tugas.index', compact('tugas', 'mataKuliah'));
    }

    public function create()
    {
        $mataKuliah = auth()->user()
            ->mataKuliah()
            ->orderBy('nama_mk')
            ->get();

        return view('tugas.create', compact('mataKuliah'));
    }

    public function store(Request $request)
    {
        $data = $this->validateTugas($request);
        $data['user_id'] = auth()->id();

        Tugas::create($data);

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil dibuat.');
    }

    public function show(Tugas $tugas)
    {
        $this->authorizeOwner($tugas);

        return view('tugas.show', compact('tugas'));
    }

    public function edit(Tugas $tugas)
    {
        $this->authorizeOwner($tugas);

        $mataKuliah = auth()->user()
            ->mataKuliah()
            ->orderBy('nama_mk')
            ->get();

        return view('tugas.edit', compact('tugas', 'mataKuliah'));
    }

    public function update(Request $request, Tugas $tugas)
    {
        $this->authorizeOwner($tugas);

        $data = $this->validateTugas($request);

        $tugas->update($data);

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tugas)
    {
        $this->authorizeOwner($tugas);

        $tugas->delete();

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }

    public function aiEstimate(Tugas $tugas)
    {
        $this->authorizeOwner($tugas);

        // 1. Panggil Agent AI
        $agent = new \App\Ai\Agents\TaskLoadEstimator();
        $prompt = "Tugas: {$tugas->judul_tugas}, Deskripsi: {$tugas->deskripsi}";
        
        try {
            // 2. Minta hasil ke Gemini (format JSON schema)
            $result = $agent->prompt($prompt);
            $data = json_decode(trim(str_replace(['```json', '```'], '', (string) $result)), true);


            // 3. Update database
            $tugas->update([
                'estimated_hours' => $data['estimated_hours'],
                'prioritas' => $data['prioritas'],
            ]);

            return back()->with('success', "AI Estimasi berhasil: {$data['estimated_hours']} jam, Prioritas {$data['prioritas']}. Alasan AI: {$data['alasan']}");
        } catch (\Exception $e) {
            // Jika API limit/error
            return back()->with('error', "Gagal melakukan estimasi AI: " . $e->getMessage());
        }
    }


    protected function validateTugas(Request $request)
    {
        return $request->validate([
            'mata_kuliah_id' => ['required', 'integer', 'exists:mata_kuliah,id'],
            'judul_tugas' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'deadline' => ['required', 'date_format:Y-m-d\TH:i', 'after:now'],
            'estimated_hours' => ['nullable', 'numeric', 'min:0'],
            'prioritas' => ['required', 'in:HIGH,MEDIUM,LOW'],
            'status' => ['required', 'in:belum_dikerjakan,sedang_dikerjakan,selesai'],
        ]);
    }

    protected function authorizeOwner(Tugas $tugas)
    {
        abort_if($tugas->user_id !== auth()->id(), 403);
    }
}
