<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class UserWeeklyChart extends ChartWidget
{
    protected ?string $heading = 'User Mingguan';

    protected int|string|array $columnSpan = 12;

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        // untuk pakai bahasa indonesia 'id'
        Carbon::setLocale('id');

        // Perulangan untuk 7 hari
        // Ngeluarin data pasti di looping
        for($i = 6; $i >= 0; $i--) { //654321

            // Menghitung tanggal hari ini dikurangi $i hari
            // Ambil tanggal hari ini,terus mundur sehari
            $date = Carbon::today()->subDays($i);

            // Tambah label hari dalam format singkat (sel, sel, rab. etc)
            // 'D' ITU ARTINYA DAY
            // BUAT NGISI LABEL YANG DIBAWAH ITU HARINYA
            $labels[] = $date->locale('id')->translatedFormat('D');

            // Hitung jumlah user yang terdaftar pada tanggal tersebut
            // kayak cari user yang tanggal daftarnya sama kaya $date, lalu dihitung jumlahnya
            $data[] = User::whereDate('created_at', $date)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'User Register',
                    'data' => $data,
                    'backgroundColor' => '#0046FF',
                    'borderRadius' => 6,
                ],
            ],
            // BIAR LABEL KAYA SENIN SELASA ITU KE ROLL SENDIRI KAYA OTOMATIC GITU
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        // BENTUK BARNYA
        return 'bar';
    }
    protected function getHeight(): ?int
    {
        // PANJANG BAR NYA
        return 600;
    }
    protected function getOptions(): array
    {
        return [
            // BIAR RESPONSIVE
            'responsive' => true,
            // KALO NGGA DI FALSE GRAFIKNYA BAKAL MEMBESAR DAN MENGECIL
            'maintainAspectRatio' => false,

            'plugins' => [
                'legends' => [
                    'display' => true,
                    // SUPAYA USER REGISTRASINYA BERADA DIBAWAH
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                // BIAR GRAFIKNYA VERTICAL
                // KALO MAU HORIZONTAL BERARTI PAKE 'X'
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        // PRECISION BUAT YANG ANGKANYA DISAMPING GITU
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
