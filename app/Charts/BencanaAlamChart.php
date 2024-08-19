<?php

namespace App\Charts;

use App\Models\NaturalDisaster;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BencanaAlamChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function getMonth()
    {
        return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    }

    public function getData(): array
    {
        $result = [];
        for ($i=1; $i < 13; $i++) {
            $month = $i;
            $result[]  = NaturalDisaster::whereMonth('time', $month)->whereYear('time', Date('Y'))->count();
        }

        return $result;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        return $this->chart->areaChart()
            ->addData('Bencana Alam', $this->getData())
            ->setXAxis($this->getMonth())
            ->setTitle("Bencana Alam Selama Tahun " . Date('Y') );
    }
}