<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicLoad;
use Illuminate\Http\Request;

class AcademicLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loads = AcademicLoad::all();
     
        return $loads;
    }


    public function getDisciplineName()
    {
  
        $query = AcademicLoad::join('disciplines', 'academic_loads.discipline_id', '=', 'disciplines.id') 
        ->select('academic_loads.id','academic_loads.discipline_id', 'disciplines.title') 
        ->get(); 

           
    
        return response()->json($query); 
    }

    public function getStudyGroup()
    {
  
        $query = AcademicLoad::join('study_groups', 'academic_loads.study_group_id', '=', 'study_groups.id') 
        ->select('academic_loads.id','academic_loads.study_group_id', 'study_groups.title') 
        ->get(); 
        return response()->json($query); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
