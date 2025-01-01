<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Dusun;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
class DusunController extends Controller
{
    public function index()
    {
        $dusuns = Dusun::all();
        return view('dusun.index', compact('dusuns'));
    }

    public function create()
    {
        if(isset($_GET['desa_id'])) {
            $desa_id = $_GET['desa_id'];
        $desa = Desa::findOrFail($desa_id);
        $provinsis = Provinsi::where('kd_prov', $desa->kd_prov)->get();
        $kabupatens = Kabupaten::where('kd_kab', $desa->kd_kab)->get();
        $kecamatans = Kecamatan::where('kd_kec', $desa->kd_kec)->get();
        $desas = Desa::where('kd_desa', $desa->kd_desa)->get();
        }else{
            $provinsis = Provinsi::all();
            $kabupatens = Kabupaten::all();
            $kecamatans = Kecamatan::all();
            $desas = Desa::all();
        }
        return view('dusun.create', compact(['desas','kecamatans', 'kabupatens', 'provinsis']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_prov' => 'required|max:50',
            'kd_kab' => 'required|max:50',
            'kd_kec' => 'required|max:50',
            'kd_desa' => 'required|max:50',
            'nama' => 'required|string|max:50'
        ]);

        Dusun::create($request->all());

        return redirect()->back()->with('success', 'kecamatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();
        $dusun = Dusun::findOrFail($id);
        return view('dusun.edit', compact(['desas', 'dusun', 'kecamatans', 'kabupatens', 'provinsis']));
    }

    public function update(Request $request, $id)
    {

        $kecamatan = Dusun::findOrFail($id);
        $kecamatan->update($request->all());

        return redirect()->route('dusun.index')->with('success', 'kecamatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kecamatan = Dusun::findOrFail($id);
        $kecamatan->delete();

        return redirect()->route('dusun.index')->with('success', 'kecamatan berhasil dihapus.');
    }
}
