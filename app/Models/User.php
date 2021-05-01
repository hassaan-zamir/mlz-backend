<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\HelperController;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;


    protected $table = 'users';

    protected $fillable = [ 'name', 'email', 'image', 'type', 'password'];

    protected $casts = [];

    public function setImageAttribute($value){
        $this->attributes['image'] = HelperController::saveFile($value);
    }

    //client relationships
    public function locations(){
        return $this->hasMany('App\Locations');
    }


    //guard relationships
    public function shifts(){
        return $this->hasMany('App\Emp_Shifts');
    }

    //admin relationships

}
