<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Auth;
use Hash;

class LoginController extends Controller
{
    //

    function LoginIndex(){
        // dd('sadadw');
        return view('login.login-index');
    }


    function LoginProcess(Request $request){
        // $data = $request;

        // $data = $request->all();
        // dd($data);
        
        $Admin = User::all();
        
        $validator = Validator::make($request->all(),
                [
                    'code_unix' => 'required',
                    'password'  => 'required' 
                ],[
                    'code_unix.required'   =>'Code Unix Harus Di isikan',
                    'password.required'    =>'password Diharuskan']
            
        
                );
                if ($validator->fails()) {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Code Unix dan Password Harus Diisi'
                    ]);
                }  
                
                $credentials = $request->only('code_unix','password');

                $code_unix = $request->code_unix;
                $password = $request->password;
                
                if (Auth::attempt($credentials)) {
                    return response()->json([
                        'code' => 200,
                    ]); 
                 }else{
                    return response()->json([
                        'status' => 500,
                        'message' => 'Email dan password tidak sesuai'
                    ]); 
                }
    }
}