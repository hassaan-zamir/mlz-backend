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
        return $this->belongsTo('App\Models\User','client');
    }

    public function tickets(){
        return $this->hasMany('App\Models\Tickets');
    }

    public function shifts(){
        return $this->hasMany('App\Models\Shifts');
    }


    use HasFactory;
}
