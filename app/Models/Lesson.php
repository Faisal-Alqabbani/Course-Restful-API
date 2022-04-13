<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'body',
        'user_id',
    ]; 
    public function user(){
        return $this->belongsTo(User::class); // SELECT * FROM USER WHERE LESSON_ID = USER_ID
    }
    
    public function tags(){
        return $this->belongsToMany(Tag::class, 'lesson_tags');
    }
}
