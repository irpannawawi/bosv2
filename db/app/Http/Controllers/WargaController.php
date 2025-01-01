<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::all();
        return view('warga.index', compact('wargas'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_warga' => 'required|string|max:50'
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')->with('success', 'warga berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_warga' => 'required|string|max:50'
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update($request->all());

        return redirect()->route('warga.index')->with('success', 'warga berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'warga berhasil dihapus.');
    }

    public function load()
    {
        $inputFileName = base_path() . '/warga.xlsx';

        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $spreadsheet->setLoadSheetsOnly('Sheet1');
        $spd = $spreadsheet->load($inputFileName);
        foreach($spd->getActiveSheet()->toArray() as $data){
            Warga::updateOrCreate([
                'nama_warga' => $data[0],
            ], [
                'nama_warga' => $data[0],
            ]);

        }
    }
}
