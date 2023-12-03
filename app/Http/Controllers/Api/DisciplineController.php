<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discipline;

class DisciplineController extends Controller
{
    public function index(){

        $disciplines = Discipline::all();
        //dd($disciplines);
        return $disciplines;
    }
}
