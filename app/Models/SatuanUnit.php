<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanUnit extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi', 'is_active'];

    public function paketKuotas()
    {
        return $this->hasMany(PaketKuota::class);
    }
}