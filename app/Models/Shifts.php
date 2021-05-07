<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{

    protected $table = 'shifts';

    protected $fillable = ['location','start_time','end_time','description','notes','incidents','checklist'];

    protected $casts = [
        'notes' => 'array',
        'incidents' => 'array',
        'checklist' => 'array',
        'start_time' => 'date',
        'end_time' => 'date'
    ];

    public function location(){
        return $this->belongsTo('App\Models\Locations');
    }

    public function guards(){
        return $this->hasMany('App\Models\Emp_Shifts');
    }


    use HasFactory;
}
