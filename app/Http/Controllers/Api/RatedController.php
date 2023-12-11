<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rated;
use App\Http\Resources\RatedResource;
use App\Http\Requests\RatedStoreRequest;
use Illuminate\Http\Response;
use App\Models\Lesson;

class RatedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$rateds = Rated::all();
        //dd($disciplines);
        //return $rateds;
        return RatedResource::collection(Rated::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RatedStoreRequest $request)
    {
        $created_rated=Rated::create($request->validated());
        return new RatedResource($created_rated);
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
        
            $lessonsData = Lesson::with('lists')->get(); 
        
            $responseData = []; 
        
  
            // $specificData = Rated::select('rateds.mark', 'rateds.user_id','lessons.date_of_lesson') 
            //         ->join('lessons', 'rateds.lesson_id', '=', 'lessons.id') 
            //         ->get();
            $specificData = Rated::select('rateds.mark', 'rateds.user_id', 'lessons.date_of_lesson')
    ->join('lessons', 'rateds.lesson_id', '=', 'lessons.id')
    ->get()
    ->groupBy('date_of_lesson')
    ->toArray();

                    // foreach ($specificData as $data) {
                    //     echo $data->mark . "<br>"; 
                    // }
            // $specificData=array( 
            // "mark" => Rated::select('mark'),
            // "user_id" => Rated::select('rateds.user_id'),
            // "date_of_lesson" => Lesson::select('lessons.date_of_lesson'));

            // $specificData = array(
            //     "mark" => Rated::select('mark')->get(),
            //     "user_id" => Rated::select('user_id')->get(),
            //     "date_of_lesson" => Lesson::select('date_of_lesson')->get()
            // );
            // $marks = $specificData["mark"];
            // foreach ($marks as $mark) {
            //     echo $mark->mark . "<br>"; 
            // }
            // foreach ($lessonsData as $lesson) { 
            //     if ($lesson->rated) { 
            //         foreach ($lesson->rated as $rated) { 
            //             $data = [ 
            //                 'lesson_id' => $lesson->lesson_id, 
            //                 'user_id' => $rated->user_id, 
            //                 'mark' => $rated->mark, 
            //             ]; 
            //             $responseData[] = $data; 
            //         }
            //     }
            // } 
        
            return response()->json($specificData); 
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rated $rated)
    {
        // $rated->update($request->validated());
        // return new RatedResource($rated);
       
        $rated->update($request->all());
        return $rated;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Rated $rated)
    {
        $rated->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
