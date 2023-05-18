<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupport;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\SupportResource;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        //A query esta dinamica, dependendo dos parametros da requisição, a query sera realizada.
        $filters = $request->all();

        $supports = $this->getUserAuth()
                ->supports()
                ->where(function($query) use($filters){
                    if(isset($filters['lesson']))
                    {
                        $query->where('lesson_id', $filters['lesson']);
                    }
                    if(isset($filters['status']))
                    {
                        $query->where('status', $filters['status']);
                    }
                    if(isset($filters['filter']))
                    {
                        $filter = $filters['filter'];
                        $query->where('description','LIKE', "%{$filters}%");
                    }
                })
                ->get();                
        
        return SupportResource::collection($supports);

    }

    public function store(StoreSupport $request)
    {
        $support = $this->getUserAuth() 
                    ->supports()
                    ->create([
                        'lesson_id' => $request->validated()['lesson'],
                        'description' => $request->validated()['description'],
                        'status' => $request->validated()['status']
                    ]);        

        return SupportResource::make($support);
    }

    private function getUserAuth(): User
    {
        //return auth()->user();
        return User::first();
    }
}
