<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function resort(){
        return $this->hasOne('App\Models\resort');
    }
    public function admin(){
        return $this->hasOne('App\Models\admin');
    }
    public function lk(){
        return $this->hasOne('App\Models\LK');
    }
    public function perlindungan(){
        return $this->hasOne('App\Models\perlindungan');
    }
}
