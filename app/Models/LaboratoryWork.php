<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryWork extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'deadline',
        'maximum_score',
 
    ];
}
