<?php

namespace App\Http\Controllers;

use App\Http\Resources\CouserResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $coursers = Course::get();

        return CouserResource::collection($coursers);
    }

    public function store($id)
    {
        $coursers = Course::findOrFail($id);

        return new CouserResource($coursers);
    }

}
