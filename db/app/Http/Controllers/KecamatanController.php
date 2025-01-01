<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::all();
        return view('kecamatan.index', compact('kecamatans'));
    }

    public function show($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $desas = Desa::where('kd_kec', $kecamatan->kd_kec)->get();
        return view('kecamatan.show', compact('kecamatan', 'desas'));
    }

    public function create()
    {
        $kabupatens = Kabupaten::all();
        $provinsis = Provinsi::all();
        return view('kecamatan.create', compact(['kabupatens', 'provinsis']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_prov' => 'required|string|max:50',
            'kd_kab' => 'required|string|max:50',
            'nama' => 'required|string|max:50'
        ]);

        Kecamatan::create($request->all());

        return redirect()->route('kecamatan.index')->with('success', 'kecamatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatan = Kecamatan::findOrFail($id);
        return view('kecamatan.edit', compact(['kecamatan', 'kabupatens', 'provinsis']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kd_prov' => 'required|max:50',
            'kd_kab' => 'required|max:50',
            'nama' => 'required|string|max:50'
        ]);

        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->update($request->all());

        return redirect()->route('kecamatan.index')->with('success', 'kecamatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();

        return redirect()->route('kecamatan.index')->with('success', 'kecamatan berhasil dihapus.');
    }
}
