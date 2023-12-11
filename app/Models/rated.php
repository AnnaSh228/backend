<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rated extends Model
{
    use HasFactory;
    protected $guarded = [];
   // protected $fillable = ['mark','lesson_id','laboratory_work_id','user_id'];
    public function lists(){
        //return $this->hasMany(LessonType::class);
        }
    }

