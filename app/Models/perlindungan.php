<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perlindungan extends Model
{
    use HasFactory;
    protected $fillable=[
        'namaPerlindungan',
        'alamat',
        'noTelp'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
