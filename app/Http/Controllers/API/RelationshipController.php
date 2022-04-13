<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RelationshipController extends Controller
{
    //
    public function userLessons($id){
            $user = User::findOrFail($id)->lessons;
            return Response::json([
                "data" => $user->toArray(),
            ], 200);
    }
    
    public function lessonTags($id){
        $lessons = Lesson::findOrFail($id)->tags;
        $fields = array();
        $filtered = array();
        foreach($lessons as $tag){
            $fields["Name"] = $tag->name;
            $filtered[] = $fields; 
        }
        return $filtered;
    }

    public function tagLessons($id){
        $tag = Tag::findOrFail($id)->lessons;
        $fields = array();
        $filtered = array();
        foreach($tag as $lesson){
            $fields["Title"] = $lesson->title;
            $fields["Content"] = $lesson->body;
            $filtered[] = $fields; 
        }
        return $filtered; 
    }
}
