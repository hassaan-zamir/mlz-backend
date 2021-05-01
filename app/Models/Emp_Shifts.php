<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emp_Shifts extends Model
{

    protected $table = 'emp_shifts';

    protected $fillable = ['employee','shift','date','stats'];

    protected $casts = [
        // 'date' => 'date'
    ];


    public function getShift()
    {
        return $this->belongsTo('App\Models\Shifts');
    }

    public function getGuard()
    {
        return $this->belongsTo('App\Models\User');
    }

    use HasFactory;
}
