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
        'start_time' => 'date:hh:mm',
        'end_time' => 'date:hh:mm'
    ];

    public function location(){
        return $this->belongsTo('App\Locations');
    }
    
    public function guards(){
        return $this->hasMany('App\Emp_Shifts');
    }


    use HasFactory;
}
