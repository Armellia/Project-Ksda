<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class satwa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'namaLatin',
        'namaSatwa',
        'jenisSatwa',
        'ordo',
        'keluarga'
    ];
}
