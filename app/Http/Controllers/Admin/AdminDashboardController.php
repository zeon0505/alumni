<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\JawabanKuesioner;
use App\Models\Kuesioner;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalAlumni     = Alumni::count();
        $kuesionerAktif  = Kuesioner::where('aktif', true)->first();
        $totalIsi        = 0;
        $totalBelumIsi   = 0;

        if ($kuesionerAktif) {
            $totalIsi      = JawabanKuesioner::where('kuesioner_id', $kuesionerAktif->id)->count();
            $totalBelumIsi = $totalAlumni - $totalIsi;
        }

        $alumniTerbaru = Alumni::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalAlumni',
            'kuesionerAktif',
            'totalIsi',
            'totalBelumIsi',
            'alumniTerbaru'
        ));
    }
}
