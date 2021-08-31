<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CustomValidator;

class PassportController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            $user = Auth::user();
            $token = $user->createToken('Token_')->accessToken;
            return response()->json($token->token);
        }
    }

    public function register(Request $request){
        $validator =CustomValidator::validate($request,[
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password' => 'required|min:4',
                'confirm_password' => 'required|same:password',
            ]
        );

        if ($validator !== true) {
            return response()->json($validator);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        User::create($input);
        return response()->json("complete");
    }
    public function profile(Request $request)
    {
        $access_token = $request->header('Authorization');
        $auth_header = explode(' ', $access_token);
        $token = $auth_header[1];
        $id = DB::table('personal_access_tokens')->where('token', $token)->first();
        return response()->json($id);
    }
}
