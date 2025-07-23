<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    
    public function pembayarans()
{
    return $this->hasMany(Pembayaran::class);
}

}
