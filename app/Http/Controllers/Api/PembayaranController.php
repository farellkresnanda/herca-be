<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    //


    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualans,id',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:1',
        ]);

        $penjualan = Penjualan::find($request->penjualan_id);
        $total_bayar = $penjualan->pembayarans()->sum('jumlah_bayar') + $request->jumlah_bayar;

        $status = $total_bayar >= $penjualan->grand_total ? 'LUNAS' : 'BELUM LUNAS';

        $pembayaran = Pembayaran::create($request->all());

        return response()->json([
            'message' => 'Pembayaran disimpan',
            'status' => $status,
            'sisa_tagihan' => max(0, $penjualan->grand_total - $total_bayar),
            'data' => $pembayaran,
        ]);
    }


    public function show($penjualan_id)
    {
        $penjualan = Penjualan::with('pembayarans')->findOrFail($penjualan_id);
        $total_bayar = $penjualan->pembayarans->sum('jumlah_bayar');

        $status = $total_bayar >= $penjualan->grand_total ? 'LUNAS' : 'BELUM LUNAS';

        return response()->json([
            'penjualan' => $penjualan,
            'total_tagihan' => $penjualan->grand_total,
            'total_bayar' => $total_bayar,
            'status' => $status,
            'sisa_tagihan' => max(0, $penjualan->grand_total - $total_bayar),
            'riwayat' => $penjualan->pembayarans
        ]);
    }
}
