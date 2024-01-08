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
        $lessons = Lesson::orderBy('date_of_lesson')->get();
        return LessonResource::collection($lessons);
    //    return LessonResource::collection(Lesson::all());
    }

    public function store(LessonStoreRequest $request)
    {
        // $created_lesson=Lesson::create($request->validated());
        // return new LessonResource($created_lesson);
        $created_lesson= new Lesson();

        $created_lesson->comment=$request->comment;
        $created_lesson->date_of_lesson=$request->date_of_lesson;
        $created_lesson->lesson_type_id=$request->lesson_type_id;
        $created_lesson->academic_load_id=$request->academic_load_id;
        $created_lesson->save();
      
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
