<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    use HasFactory;
    protected $fillable = ['date_of_lesson','lesson_type_id','academic_load_id'];
    public function lists(){
    return $this->hasMany(Rated::class, 'lesson_id', 'id');
    }
}
