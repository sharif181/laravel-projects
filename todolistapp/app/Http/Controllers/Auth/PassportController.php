<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomValidator;


class PassportController extends Controller
{
    public function login(Request $req){
        $email = $req->input('email');
        $password = $req->input('password');
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('Token_')->accessToken;
            return response()->json($token);
        }
    }


    public function register(Request $request){

        $validator = CustomValidator::validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:4',
            'c_password' => 'required|same:password',
        ]);
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
        $token_parts = explode('.', $token);
        $token_header = $token_parts[1];
        $token_header_json = base64_decode($token_header);
        $token_header_array = json_decode($token_header_json, true);
        $token_id = $token_header_array['jti'];
        $user_id = DB::table('oauth_access_tokens')->where('id', $token_id)->first();
        return response()->json($user_id);
    }
}

