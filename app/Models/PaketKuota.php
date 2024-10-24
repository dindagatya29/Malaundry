<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketKuota extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'berat', 'satuan_unit_id', 'harga', 'cabang', 'is_active'];

    public function satuanUnit()
    {
        return $this->belongsTo(SatuanUnit::class);
    }
}