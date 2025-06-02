<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwal_periksas = JadwalPeriksa::where('id_dokter', Auth::user()->id)->get();
        return view('dokter.jadwal-periksa.index', compact('jadwal_periksas'));
    }
    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    public function store(Request $request)
    {
        $validatedData  = $request->validate([
            'hari'=>'required|string|max:10',
            'jam_mulai'=>'required|date_format:H:i',
            'jam_selesai'=>'required|date_format:H:i|after:jam_mulai',
        ]);
        if(
            JadwalPeriksa::where('id_dokter', Auth::user()->id)
                ->where('hari', $validatedData['hari'])
                ->where('jam_mulai', $validatedData['jam_mulai'])
                ->where('jam_selesai', $validatedData['jam_selesai'])
                ->exists()
        ){
            return back()->withInput();
        }
        JadwalPeriksa::create([
            'id_dokter'=>Auth::user()->id,
            'hari'=>$validatedData['hari'],
            'jam_mulai'=>$validatedData['jam_mulai'],
            'jam_selesai'=>$validatedData['jam_selesai'],
            'status'=>0,
        ]);

        return redirect()->route('dokter.jadwal-periksa.index');
    }

    public function edit($id)
    {
        $jadwal_periksa = JadwalPeriksa::findOrFail($id);
        return view('dokter.jadwal-periksa.edit', compact('jadwal_periksa'));
    }

    public function update(Request $request, $id)
    {
        $jadwal_periksa = JadwalPeriksa::findOrFail($id);
        if(!$jadwal_periksa->status){
            JadwalPeriksa::where('id_dokter', Auth::user()->id)->update(['status'=>0]);
            $jadwal_periksa->status = true;
            $jadwal_periksa->save();
            return redirect()->route('dokter.jadwal-periksa.index');
        }
        // $jadwal_periksa->update([
        //     'id_dokter'=>$request->id_dokter,
        //     'hari'=>$request->hari,
        //     'jam_mulai'=>$request->jam_mulai,
        //     'jam_selesai'=>$request->jam_selesai,
        //     'status'=>$request->status,
        // ]);
        $jadwal_periksa->status = false;
        $jadwal_periksa->save();

        return redirect()->route('dokter.jadwal-periksa.index');
    }


    public function destroy($id)
    {
        $jadwal_periksa = JadwalPeriksa::findOrFail($id);
        $jadwal_periksa->delete();

        return redirect()->route('dokter.jadwal-periksa.index');
    }
}
