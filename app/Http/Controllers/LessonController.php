<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index($id)
    {
        $lessons = Lesson::where('module_id', $id)->get();

        return LessonResource::collection($lessons);
    }

    public function store($id)
    {
        $lessons = Lesson::findOrFail($id);

        return LessonResource::make($lessons);

    }
}
