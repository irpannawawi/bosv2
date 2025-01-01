<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
class KabupatenController extends Controller
{
    public function index()
    {
        $kabupatens = Kabupaten::all();
        return view('kabupaten.index', compact('kabupatens'));
    }

    public function create()
    {
        $provinsis = Provinsi::all();
        return view('kabupaten.create', compact('provinsis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_prov' => 'required|string|max:50',
            'kd_kab' => 'required|string|max:50',
            'nama' => 'required|string|max:50'
        ]);

        Kabupaten::create($request->all());

        return redirect()->route('kabupaten.index')->with('success', 'kabupaten berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        $provinsis = Provinsi::all();
        return view('kabupaten.edit', compact(['kabupaten', 'provinsis']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kd_prov' => 'required|max:50',
            'kd_kab' => 'required|max:50',
            'nama' => 'required|string|max:50'
        ]);

        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->update($request->all());

        return redirect()->route('kabupaten.index')->with('success', 'kabupaten berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->delete();

        return redirect()->route('kabupaten.index')->with('success', 'kabupaten berhasil dihapus.');
    }
}
