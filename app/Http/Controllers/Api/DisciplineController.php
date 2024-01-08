<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DisciplineResource;
use App\Models\Discipline;
use App\Http\Requests\StoreDisciplineRequest;
use App\Http\Requests\UpdateDisciplineRequest;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DisciplineResource::collection(Discipline::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDisciplineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Discipline $discipline)
    {
        return new DisciplineResource($discipline);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisciplineRequest $request, Discipline $discipline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discipline $discipline)
    {
        //
    }
}
