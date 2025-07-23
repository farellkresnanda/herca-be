<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class KomisiController extends Controller
{
    public function index()
    {
        $data = DB::table('penjualans')
            ->join('marketings', 'penjualans.marketing_id', '=', 'marketings.id')
            ->select(
                'marketings.name as marketing',
                DB::raw("DATE_FORMAT(date, '%Y-%m') as bulan"),
                DB::raw('SUM(grand_total) as omzet')
            )
            ->groupBy('marketing', 'bulan')
            ->orderBy('marketing')
            ->get()
            ->map(function ($item) {
                $omzet = (int) $item->omzet;
                $komisiPersen = 0;

                if ($omzet >= 500_000_000) {
                    $komisiPersen = 10;
                } elseif ($omzet >= 200_000_000) {
                    $komisiPersen = 5;
                } elseif ($omzet >= 100_000_000) {
                    $komisiPersen = 2.5;
                }

                return [
                    'marketing' => $item->marketing,
                    'bulan' => date('F', strtotime($item->bulan . '-01')),
                    'omzet' => $omzet,
                    'komisi_persen' => $komisiPersen . '%',
                    'komisi_nominal' => (int) ($omzet * ($komisiPersen / 100)),
                ];
            });

        return response()->json($data);
    }
}
