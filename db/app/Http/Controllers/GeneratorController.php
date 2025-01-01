<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Desa;
use App\Models\Dusun;
use App\Models\Laporan;
use App\Models\Uraian;
use App\Models\Warga;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GeneratorController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::all();
        return view('generator.index', compact('anggotas'));
    }

    public function generate(Request $request)
    {
        Laporan::truncate();
        $tgl_start = (int) explode('-', $request->tgl_start)[2];
        $tgl_end = (int) explode('-', $request->tgl_end)[2];
        $jml = $request->jml;
        $bulan = explode('-', $request->tgl_start)[1];
        $tahun = explode('-', $request->tgl_start)[0];
        $tanggal_bulan = ($request->tgl_start);
        $anggotas = Anggota::all();
        foreach ($anggotas as $anggota) {
            $has_uraian = [];
            for ($i = $tgl_start; $i <= $tgl_end; $i++) {
                for ($j = 1; $j <= $jml; $j++) {
                    $tgl  = str_pad($i, 2, '0', STR_PAD_LEFT);
                    
                    $keterangan = Uraian::whereNotIn('keterangan', $has_uraian)->inRandomOrder()->first();
                    if($keterangan == null){
                        break;
                    }
                    $dusun = Dusun::where([
                        'kd_desa' => $anggota->kd_desa,
                        'kd_kec' => $anggota->kd_kec,
                    ])->inRandomOrder()->first();
                    if($dusun == null){
                        break;
                        dd('gagal');
                    }
                    $data = [
                        'nrp' => $anggota->nrp,
                        'tanggal' => $tahun . '-' . $bulan . '-' . $tgl,
                        'nama' => Warga::inRandomOrder()->first()->nama_warga,
                        'dusun' => $dusun->nama,
                        'rt' => str_pad(random_int(1, 15), 3, '0', STR_PAD_LEFT),
                        'rw' => str_pad(random_int(1, 15), 3, '0', STR_PAD_LEFT),
                        'desa' => $anggota->desa->nama,
                        'keterangan' => Uraian::whereNotIn('keterangan', $has_uraian)->inRandomOrder()->first()->keterangan,
                    ];
                    array_push($has_uraian, $data['keterangan']);

                    Laporan::create($data);
                }
            }
        }

        return redirect()->back();
    }

    public function download($nrp)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'TANGGAL');
        $sheet->setCellValue('C1', 'NAMA');
        $sheet->setCellValue('D1', 'DUSUN');
        $sheet->setCellValue('E1', 'RT');
        $sheet->setCellValue('F1', 'RW');
        $sheet->setCellValue('G1', 'DESA');
        $sheet->setCellValue('H1', 'KETERANGAN');

        // looping data 
        $laporan = Laporan::where('nrp', $nrp)->get();
        $no = 1;
        foreach ($laporan as $data) {
            $sheet->setCellValue('A' . ($no + 1), $no);
            $sheet->setCellValue('B' . ($no + 1), $data->tanggal);
            $sheet->setCellValue('C' . ($no + 1), $data->nama);
            $sheet->setCellValue('D' . ($no + 1), $data->dusun);
            $sheet->setCellValue('E' . ($no + 1), $data->rt);
            $sheet->setCellValue('F' . ($no + 1), $data->rw);
            $sheet->setCellValue('G' . ($no + 1), $data->desa);
            $sheet->setCellValue('H' . ($no + 1), $data->keterangan);
            $no++;
        }
        // Proses file excel
        $desa = Anggota::where('nrp', $nrp)->first()->desa->nama;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="list_'.strtolower($desa).'.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
