<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupport;
use App\Http\Requests\StoreSupport;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\SupportResource;
use App\Http\Resources\ReplySupportResource;

class SupportController extends Controller
{

    private function getUserAuth(): User
    {
        return auth()->user();

        //para teste
        //return User::first();
    }

    //suports do ususario expecifico logado
    public function mySupports(Request $request)
    {
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
                    if(isset($filters['user']))
                    {
                        $user = $this->getUserAuth();
                        $query->where('status', $user->id );
                    }
                })
                ->orderBy('updated_at')
                ->get();                
        
        return SupportResource::collection($supports);
    }

    public function index(Request $request, Support $support)
    {
        //A query esta dinamica, dependendo dos parametros da requisição, a query sera realizada.
        $filters = $request->all();

        // $support = new Support();
        $supports = $support           
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
                ->orderBy('updated_at')
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

    //StoreReplySupport
    public function createReply(Request $request, Support $support)
    {
        
        $user = $this->getUserAuth();
        
        // O StoreReplySupport não esta respondendo como deveria, metodo provisorio de validação
        if(isset($request->description) && isset($request->support_id))
        {
            $reply = $support->findOrFail($request->support_id) 
                        ->replies()
                        ->create([    
                            'support_id' => $request->support_id,                   
                            'description' => $request->description,
                            'user_id' => $user->id
                        ]);                             
                
            return ReplySupportResource::make($reply);

        }else{
            return response()->json([
                'description' => 'Obrigatorio',
                'support' => 'Obrigatorio',
            ],404);
        }
        
    }//end method




}
