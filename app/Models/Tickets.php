<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Tickets extends Model
{

    protected $table = 'tickets';
    
    protected $fillable = ['email','name','model','unit_no','license','phone','location'];

    protected $casts = [];

    protected $dates = ['created_at', 'updated_at'];


    public function location()
    {
        return $this->belongsTo('App\Locations');
    }


    public function scopeActive($query)
    {
        return $query->where('created_at', '>' , Carbon::now()->subHours(1));
    }

    use HasFactory;
}
