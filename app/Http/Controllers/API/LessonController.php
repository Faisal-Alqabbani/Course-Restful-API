<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Resources\Lesson as LessonResurece; 
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth:api'); 
    }
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50? $request->input('limit'):15;
        $lesson = LessonResurece::collection(Lesson::paginate($limit)); 
        return $lesson->response()->setStatusCode('200');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return Lesson::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $lesson = new LessonResurece(Lesson::findOrFail($id)); 
        return $lesson->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idLesson = Lesson::findOrFail($id);
        $this->authorize('update', $idLesson);
        $lesson = new LessonResurece(Lesson::findOrFail($id));
        $lesson->update($request->all());
        return $lesson->response()->setStatusCode(200, "Lesson updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $idLesson = Lesson::findOrFail($id);
        $this->authorize('delete', $idLesson);
        Lesson::findOrFail($id)->delete(); 
        return 204;
    }
}
