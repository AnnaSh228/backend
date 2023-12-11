<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaboratoryWork;
class LaboratoryWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laboratory_works = LaboratoryWork::all();
        //dd($disciplines);
        return $laboratory_works;
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
        return LaboratoryWork::findOrFail($id);
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
