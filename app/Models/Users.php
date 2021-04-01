<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\HelperController;

class Users extends Model
{

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
    use HasFactory;
}
