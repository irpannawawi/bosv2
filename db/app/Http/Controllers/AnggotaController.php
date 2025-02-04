<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::all();
        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        $desas = Desa::all();
        return view('anggota.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50'
        ]);
        $kecamatan = Desa::where('kd_desa', $request->kd_desa)->first();
        Anggota::create([
            'nrp' => $request->nrp,
            'username' => $request->username,
            'password' => $request->password,
            'nama' => $request->nama,
            'pangkat' => $request->pangkat,
            'kd_kec' => $kecamatan->kd_kec,
            'kd_desa' => $kecamatan->kd_desa,
        ]);

        return redirect()->route('anggota.index')->with('success', 'anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $desas = Desa::all();
        $kecamatans = Kecamatan::all();
        return view('anggota.edit', compact('anggota', 'desas', 'kecamatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:50'
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update($request->all());

        return redirect()->route('anggota.index')->with('success', 'anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'anggota berhasil dihapus.');
    }
}
