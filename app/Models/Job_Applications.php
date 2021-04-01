<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_Applications extends Model
{

    protected $table = 'job_applications';
    
    protected $fillable = [];

    protected $casts = [];

    
    use HasFactory;
}
