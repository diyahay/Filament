<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembelianItem extends Model
{
    use HasFactory;

/**
 * Get the barang that owns the PembelianItem
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function barang(): BelongsTo
{
    return $this->belongsTo(Barang::class);
}



public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
    
public function suplier()
    {
        return $this->hasOneThrough(Suplier::class, Pembelian::class, 'id', 'id', 'pembelian_id', 'suplier_id');
    }

//protected static function booted()
  //  {
     //   static::saving(function ($pembelianItem) {
     //       $pembelianItem->total = $pembelianItem->jumlah * $pembelianItem->harga;
      //  });
   // }
}

