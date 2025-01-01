<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Dusun;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
class DesaController extends Controller
{
    public function index()
    {
        $desas = Desa::all();
        return view('desa.index', compact('desas'));
    }

    public function show($id)
    {
        $desa = Desa::findOrFail($id);
        $dusuns = Dusun::where(['kd_desa'=>$desa->kd_desa, 'kd_kec'=>$desa->kd_kec])->get();
        return view('desa.show', compact('desa', 'dusuns'));
    }

    public function create()
    {
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        return view('desa.create', compact(['kecamatans', 'kabupatens', 'provinsis']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_kec' => 'required|max:50',
            'kd_desa' => 'required|max:50',
            'nama' => 'required|string|max:50'
        ]);

        Desa::create($request->all());

        return redirect()->route('desa.index')->with('success', 'kecamatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $desa = Desa::findOrFail($id);
        $kecamatans = Kecamatan::all();
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        return view('desa.edit', compact(['desa', 'kecamatans', 'provinsis', 'kabupatens']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kd_kec' => 'required|max:50',
            'nama' => 'required|string|max:50'
        ]);

        $kecamatan = Desa::findOrFail($id);
        $kecamatan->update($request->all());

        return redirect()->route('desa.index')->with('success', 'kecamatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kecamatan = Desa::findOrFail($id);
        $kecamatan->delete();

        return redirect()->route('desa.index')->with('success', 'kecamatan berhasil dihapus.');
    }
}
