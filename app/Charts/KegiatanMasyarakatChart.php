<?php

namespace App\Charts;

use App\Models\PublicActivity;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KegiatanMasyarakatChart
{
    protected $chart;

    
    // Tentukan rentang tanggal
    private $startDate;
    private $endDate;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;

        // Tentukan rentang tanggal
        $this->startDate = Carbon::now()->firstOfMonth();
        $this->endDate = Carbon::now()->lastOfMonth();
    }

    public function data(): array
    {
        // Misalkan kamu ingin menghitung jumlah entri per hari
        $hasil = [];
        for ($date = $this->startDate; $date->lte($this->endDate); $date->addDay()) {
            $tanggal = $date->toDateString();
            $jumlah  = PublicActivity::whereDate('time', $tanggal)->count();
            $hasil[] = $jumlah;
        }

        return $hasil;
    }

    public function getDate()
    {
        $tanggal = [];
        for ($date = $this->startDate; $date->lte($this->endDate); $date->addDay()) {
            $tanggal[] = $date->toDateString();
        }

        return $tanggal;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('Kegiatan Masyarakat', $this->data())
            ->setTitle('Total Kegiatan Masayarakat Berdasarhan Hari')
            ->setXAxis($this->getDate());
    }
}
