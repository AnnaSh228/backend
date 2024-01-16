<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaboratoryWorkRequest;
use App\Http\Requests\UpdateLaboratoryWorkRequest;
use App\Http\Resources\LaboratoryWorkResource;
use Illuminate\Http\Request;
use App\Models\LaboratoryWork;

class LaboratoryWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        if ($request->has('discipline_id')) {

            $laboratory_works = LaboratoryWork::where('discipline_id', $request->discipline_id)
                ->orderBy('id')
                ->get();
        } else {

            $laboratory_works = LaboratoryWork::all();
        }

        return $laboratory_works;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created_lesson = new LaboratoryWork();

        $created_lesson->title = $request->title;
        $created_lesson->deadline = $request->deadline;
        $created_lesson->maximum_score = $request->maximum_score;
        $created_lesson->discipline_id = $request->discipline_id;
        $created_lesson->save();

        return new LaboratoryWorkResource($created_lesson);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return LaboratoryWork::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaboratoryWorkRequest $request, $id)
    {
        $lw = LaboratoryWork::findOrFail($id);
        $lw->update($request->only("title", "deadline", "maximum_score"));
        return response()->json([
            "data" => [
                "success" => true
            ]
        ]);
        // $laboratoryWork->update($request->validated());
        // return new LaboratoryWorkResource($laboratoryWork);

        // $laboratoryWork = $laboratoryWork->update($request->all()); 
        // return new LaboratoryWorkResource($laboratoryWork);
        //$laboratoryWork = $laboratoryWork->update($request->all()); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
