<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if(!$user || !Hash::check($request->password, $user->password))
        {
            throw ValidationException::withMessages(
                [
                    'email' => ['The provided credencials are incorrect.']
                ]);
        }//end if

        //vai deletar todos os tokens que esse usuario tem e assim deslogar, caso ele esteja logado em outro.
        $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token'=>$token
        ]);  

    }//end method

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['success'=> true]);

    }//end method

    public function me()
    {
        $user = auth()->user();

        return UserResource::make($user);


    }//end method


}//end class
