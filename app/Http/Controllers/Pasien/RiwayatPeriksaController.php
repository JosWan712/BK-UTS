<?php

namespace App\Http\Controllers\pasien;

use App\Models\JanjiPeriksa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RiwayatPeriksaController extends Controller
{
    public function index()
    {
        $janjiPeriksas = JanjiPeriksa::where('id_pasien', Auth::user()->id)
            ->get();

        return view('pasien.riwayat-periksa.index')->with([
            'janjiPeriksas' => $janjiPeriksas,
        ]);
    }

    public function detail($id)
    {
        $janjiPeriksa = JanjiPeriksa::with(['jadwalPeriksa', 'periksa'])
            ->findOrFail($id);

        return view('pasien.riwayat-periksa.detail')->with([
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }

    public function riwayat($id)
    {
        $janjiPeriksa = JanjiPeriksa::with(['jadwalPeriksa', 'periksa'])
            ->findOrFail($id);

        return view('pasien.riwayat-periksa.riwayat')->with([
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }
}
