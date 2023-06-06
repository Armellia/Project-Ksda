<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class resort extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'user_id',
        'namaResort',
        'alamatResort',
        'noTelpresort'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
