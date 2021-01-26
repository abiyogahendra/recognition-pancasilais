<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        // // $data = $request->all();
        // dd($data->toArray());
        
        $Admin = User::all();
        
        $validator = Validator::make($request->all(),
                [
                    'email'     => 'required | email',
                    'password'  => 'required' 
                ],[
                    'email.required'       =>'Email Harus Di isikan',
                    'password.required'    =>'password Diharuskan']
            
        
                );
                if ($validator->fails()) {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Email dan password harus diisi'
                    ]);
                }  
                
                $credentials = $request->only('email','password');

                $email = $request->email;
                $password = $request->password;

                if (Auth::attempt($credentials)) {
                    return redirect()->route('dashboard');
                 }else{
                        return response()->json([
                            'status' => 500,
                            'message' => 'Email dan password tidak sesuai'
                        ]); 
                }
    }
}