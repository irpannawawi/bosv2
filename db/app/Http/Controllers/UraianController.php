<?php

namespace App\Http\Controllers;

use App\Models\Uraian;
use Illuminate\Http\Request;

class UraianController extends Controller
{
    public function index()
    {
        $uraians = Uraian::all();
        return view('uraian.index', compact('uraians'));
    }

    public function create()
    {
        $inputFileName = base_path() . '/uraian2.xlsx';
        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $spreadsheet->setLoadSheetsOnly('Sheet1');
        $spd = $spreadsheet->load($inputFileName);
        foreach($spd->getActiveSheet()->toArray() as $data){
            Uraian::updateOrCreate([
                'keterangan' => $data[0],
                'tags' => $data[1]
            ], [
                'keterangan' => $data[0],
                'tags' => $data[1]
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_uraian' => 'required|string|max:50'
        ]);

        Uraian::create($request->all());

        return redirect()->route('uraian.index')->with('success', 'uraian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $uraian = Uraian::findOrFail($id);
        return view('uraian.edit', compact('uraian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_uraian' => 'required|string|max:50'
        ]);

        $uraian = Uraian::findOrFail($id);
        $uraian->update($request->all());

        return redirect()->route('uraian.index')->with('success', 'uraian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $uraian = Uraian::findOrFail($id);
        $uraian->delete();

        return redirect()->route('uraian.index')->with('success', 'uraian berhasil dihapus.');
    }
}
