<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['penjualan_id', 'tanggal_bayar', 'jumlah_bayar'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
