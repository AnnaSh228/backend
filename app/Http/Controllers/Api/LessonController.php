<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonStoreRequest;
use App\Http\Resources\LessonResource;
use Illuminate\Http\Response;
use App\Models\Lesson;


class LessonController extends Controller
{
  
    public function index()
    {
      //  $lessons = Lesson::all();
        //dd($disciplines);
        //return $lessons;
       // return LessonResource::collection(Lesson::all());
       return LessonResource::collection(Lesson::all());
    }

    public function store(LessonStoreRequest $request)
    {
        $created_lesson=Lesson::create($request->validated());
        return new LessonResource($created_lesson);
    }


    public function show(Lesson $lesson)
    {
       // return Lesson::find($id);
       return new LessonResource($lesson);
    }

 
    public function update(LessonStoreRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());
        return new LessonResource($lesson);
    }


    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
