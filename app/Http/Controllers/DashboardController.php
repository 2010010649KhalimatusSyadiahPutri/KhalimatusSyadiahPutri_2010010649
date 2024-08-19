<?php

namespace App\Http\Controllers;

use App\Charts\BencanaAlamChart;
use App\Charts\KegiatanMasyarakatChart;

class DashboardController extends Controller
{
    public function admin(BencanaAlamChart $bencanaAlamChart, KegiatanMasyarakatChart $kegiatanMasyarakatChart)
    {
        if ((auth()->user()->position->name ?? '') != 'admin') {
            abort(403, 'anda bukan admin');
        }

        return view('dashboard', [
            'title' => 'Dashboard Admin',
            'bencana' => $bencanaAlamChart->build(),
            'kegiatan' => $kegiatanMasyarakatChart->build(),
        ]);
    }
}
