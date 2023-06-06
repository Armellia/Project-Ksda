<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;

    protected $fillable=[
        'namaAdmin',
        'alamat',
        'noTelp',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
