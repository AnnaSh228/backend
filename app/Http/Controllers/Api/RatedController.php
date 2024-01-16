<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LaboratoryWork;
use Illuminate\Http\Request;
use App\Models\Rated;
use App\Http\Resources\RatedResource;
use App\Http\Requests\RatedStoreRequest;
use Illuminate\Http\Response;
use App\Models\Lesson;

class RatedController extends Controller
{

    public function index(Request $request)
    {
        $query = Rated::join('users', 'rateds.user_id', '=', 'users.id')
            ->join('lessons', 'rateds.lesson_id', '=', 'lessons.id')
            ->join('academic_loads', 'lessons.academic_load_id', '=', 'academic_loads.id');

        if ($request->has('study_group_id') && $request->has('discipline_id')) {
            $query->where('academic_loads.study_group_id', $request->study_group_id)
                ->where('academic_loads.discipline_id', $request->discipline_id)
                ->where('users.study_group_id', $request->study_group_id);
        }

        $query->orderBy('rateds.id');

        $ratedResources = $query->get([
            'rateds.id',
            'rateds.mark',
            'rateds.lesson_id',
            'rateds.laboratory_work_id',
            'rateds.user_id'
        ]);

        return RatedResource::collection($ratedResources);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RatedStoreRequest $request)
    {

        $newMark = $request->input('mark');


        if ($newMark == -1) {
            $rated = new Rated;
            $rated->laboratory_work_id = null;
            $rated->mark = -1;
            $rated->comment = $request->comment;
            $rated->lesson_id = $request->lesson_id;
            $rated->user_id = $request->user_id;
            $rated->save();

            return new RatedResource($rated);
        }

        $laboratory_work_id = $request->input('laboratory_work_id');
        $laboratoryWork = LaboratoryWork::find($laboratory_work_id);

        if (!$laboratoryWork) {
            //return response()->json(['error' => 'Лабораторная работа не найдена'], 404);
            $rated = new Rated;
            $rated->laboratory_work_id = null;
            $rated->mark = $request->mark;
            $rated->comment = $request->comment;
            $rated->lesson_id = $request->lesson_id;
            $rated->user_id = $request->user_id;
            $rated->save();

            return new RatedResource($rated);
        }

        $score = $laboratoryWork->maximum_score;

        if (($newMark <= $score) && ($newMark > 0)) {
            $rated = new Rated;
            $rated->laboratory_work_id = $laboratory_work_id;
            $rated->mark = $newMark;
            $rated->comment = $request->comment;
            $rated->lesson_id = $request->lesson_id;
            $rated->user_id = $request->user_id;
            $rated->save();

            return new RatedResource($rated);
        } else {
            return response()->json(['error' => 'Новая оценка больше чем установленное значение score'], 400);
        }
        // $created_rated=Rated::create($request->validated());

        // return new RatedResource($created_rated);

        //     $created_rated= new Rated();
        //     $created_rated->mark= $request->mark;
        //    $created_rated->comment=$request->comment;
        //    $created_rated->lesson_id=$request->lesson_id;
        //    $created_rated->laboratory_work_id=$request->laboratory_work_id;
        //    $created_rated->user_id=$request->user_id;
        //   $created_rated->save();

        //     return new RatedResource($created_rated);
        //-----------------------------------------------

        // $laboratory_work_id = $request->input('laboratory_work_id');
        // $newMark = $request->input('mark');
        // $laboratoryWork = LaboratoryWork::find($laboratory_work_id);

        // if (!$laboratoryWork) {
        //     return response()->json(['error' => 'Лабораторная работа не найдена'], 404);
        // }


        // $score = $laboratoryWork->maximum_score;
        // echo "оценка $score";

        // if (($newMark <= $score) && ($newMark > 0)) {

        //     $rated = new Rated;
        //     $rated->laboratory_work_id = $laboratory_work_id;
        //     $rated->mark = $newMark;
        //     $rated->comment = $request->comment;
        //     $rated->lesson_id = $request->lesson_id;
        //     $rated->user_id = $request->user_id;
        //     $rated->save();

        //     return new RatedResource($rated);
        // } else {
        //     return response()->json(['error' => 'Новая оценка больше чем установленное значение score'], 400);
        // }

    }

    /**
     * Display the specified resource.
     */
    public function show(Rated $rated)
    {
        return new RatedResource($rated);
    }
    public function getLessonData()
    {



        $specificData = Rated::select('rateds.mark', 'rateds.user_id', 'lessons.date_of_lesson')
            ->join('lessons', 'rateds.lesson_id', '=', 'lessons.id')
            ->get()
            ->groupBy('date_of_lesson')
            ->toArray();



        return response()->json($specificData);
    }

    public function update(RatedStoreRequest $request, Rated $rated)
    {


        $newMark = $request->input('mark');
        $laboratoryWork = $rated->laboratory_work_id;
        $laboratoryWork = LaboratoryWork::find($laboratoryWork);

        if ($newMark == 0) {
            $rated->delete();
            return response(null, Response::HTTP_NO_CONTENT);
        } else if (!$laboratoryWork) {
            // return response()->json(['error' => 'Лабораторная работа не найдена'], 404);
            $rated->mark = $newMark;
            $rated->save();
            return new RatedResource($rated);

        } else {

            $score = $laboratoryWork->maximum_score;

            if (($newMark <= $score) && ($newMark > 0)) {

                $rated->mark = $newMark;
                $rated->save();

                return new RatedResource($rated);
            } else if ($newMark == 0) {
                $rated->delete();
                return response(null, Response::HTTP_NO_CONTENT);

            } else {
                return response()->json(['error' => 'Новая оценка больше чем установленное значение score'], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rated $rated)
    {
        $rated->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
