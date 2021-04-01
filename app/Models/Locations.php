<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table = 'locations';

    protected $fillable = [ 'name' , 'address' , 'client' ];

    protected $casts = [];


    public function client(){
        return $this->belongsTo('App\Users');
    }

    public function tickets(){
        return $this->hasMany('App\Tickets');
    }

    public function shifts(){
        return $this->hasMany('App\Shifts');
    }


    use HasFactory;
}
