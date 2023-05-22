<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        //ele espera uma requisição query string
        $request->validate(['email'=>'required|email']);

        $status = Password::sendResetLink($request->only('email'));
        //Retorna-rá Password::RESET_LINK_SENT caso o email seja valido e tenha sido enviado com sucesso

        return $status === Password::RESET_LINK_SENT 
                ? response()->json(['status'=> __($status)])
                : response()->json(['email'=> __($status)], 422);

    }
}//end class
