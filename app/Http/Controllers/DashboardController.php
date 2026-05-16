<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalTugas = $user->tugas()->count();
        $deadlineDekat = $user->tugas()->whereBetween('deadline', [now(), now()->addDays(3)])->count();
        $mataKuliahCount = $user->mataKuliah()->count();
        $tugasHariIni = $user->tugas()->whereDate('deadline', now())->count();
        $belumDikerjakan = $user->tugas()->where('status', 'belum_dikerjakan')->count();
        $sedangDikerjakan = $user->tugas()->where('status', 'sedang_dikerjakan')->count();
        $selesai = $user->tugas()->where('status', 'selesai')->count();

        $upcoming = $user->tugas()
            ->with('mataKuliah')
            ->where('deadline', '>=', now())
            ->orderBy('deadline')
            ->limit(4)
            ->get();

        $overloadRisk = $totalTugas ? min(100, round(($deadlineDekat / $totalTugas) * 100)) : 0;
        $aiInsight = (string) (new \App\Ai\Agents\StudyTimeRecommender)->prompt("Tugasku: " . json_encode($user->tugas()->where('status', '!=', 'selesai')->get()));


        return view('dashboard', compact(
            'totalTugas',
            'deadlineDekat',
            'mataKuliahCount',
            'tugasHariIni',
            'belumDikerjakan',
            'sedangDikerjakan',
            'selesai',
            'upcoming',
            'overloadRisk',
            'aiInsight'
        ));
    }
}
