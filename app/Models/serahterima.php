<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serahterima extends Model
{
    use HasFactory;
    protected $table='resort_satwa';

    protected $fillable=[
        'resort_id',
        'lk_id',
        'satwa_id',
        'jumlah',
        'noSerahterima',
        'tanggal',
        'tanggalTerima',
    ];
}
