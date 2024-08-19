<?php

namespace App\Http\Controllers;

use App\Models\Operational;
use App\Models\Outcome;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function cetakGabungan()
    {
        // Ambil data dari model
        $dataMasuk = Operational::all();
        $dataKeluar = Outcome::all();

        // Buat PDF dengan data gabungan
        $pdf = Pdf::loadView('laporan.cetak-gabungan', [
            'dataMasuk' => $dataMasuk,
            'dataKeluar' => $dataKeluar,
        ]);
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->download('laporan_gabungan_' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    
}