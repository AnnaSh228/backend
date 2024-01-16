<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonStoreRequest;
use App\Http\Resources\LessonResource;
use App\Models\AcademicLoad;
use Illuminate\Http\Response;
use App\Models\Lesson;
use Illuminate\Http\Request;


class LessonController extends Controller
{

    public function index(Request $request)
    {



        $query = Lesson::query()
            ->join('academic_loads', 'lessons.academic_load_id', '=', 'academic_loads.id');
        if ($request->has('study_group_id') && $request->has('discipline_id')) {
            $query->where('academic_loads.study_group_id', $request->study_group_id)
                ->where('academic_loads.discipline_id', $request->discipline_id)
            ;
        }
        $query->orderBy('lessons.date_of_lesson');

        $lessonsResources = $query->get([
            'lessons.id',
            'lessons.comment',
            'lessons.date_of_lesson',
            'lessons.academic_load_id',
        ]);

        return LessonResource::collection($lessonsResources);







    }


    public function store(LessonStoreRequest $request)
    {
        $created_lesson = new Lesson();

        $created_lesson->comment = $request->comment;
        $created_lesson->date_of_lesson = $request->date_of_lesson;
        $created_lesson->lesson_type_id = $request->lesson_type_id;


        $academicLoadId = AcademicLoad::where('discipline_id', $request->discipline_id)
            ->where('study_group_id', $request->study_group_id)
            ->pluck('id')
            ->first();

        if ($academicLoadId) {
            $created_lesson->academic_load_id = $academicLoadId;
            $created_lesson->save();
            return new LessonResource($created_lesson);
        }


        return response()->json(['error' => 'Не удалось найти academic_load_id для данного discipline_id'], 404);
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
