<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ChartController extends Controller
{
    public function index()
    {
        $chart = new LarapexChart;

        // Area Chart
        $areaChart = $chart->areaChart()
            ->setTitle('Penjualan 2024')
            ->setSubtitle('Data Bulanan')
            ->addData('Tahun Lalu', [40, 93, 35, 90, 34, 91])
            ->addData('Tahun Ini', [70, 29, 77, 28, 55, 45])
            ->setXAxis(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun']);

        // Pie Chart
        $pieChart = $chart->pieChart()
            ->setTitle('Top Kategori')
            ->addData([40, 25, 35])
            ->setLabels(['Elektronik', 'Fashion', 'Kuliner']);

        // Bar Chart
        $barChart = $chart->barChart()
            ->setTitle('Performa Sales')
            ->setXAxis(['Andi', 'Budi', 'Cici'])
            ->addData('Target', [100, 100, 100])
            ->addData('Realisasi', [85, 110, 95])
            ->setColors(['#ffc107', '#303F9F']);

        return view('dashboard_chart', compact('areaChart', 'pieChart', 'barChart'));
    }
}
