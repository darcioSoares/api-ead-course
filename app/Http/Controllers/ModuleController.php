<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ModuleResource;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index(string $id)
    {

        $modules = Module::where('course_id', $id)->get();

        return ModuleResource::collection($modules);

    }
}
