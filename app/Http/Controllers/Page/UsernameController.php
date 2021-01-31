<?php

namespace App\Http\Controllers\Page;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Carbon\Carbon;

class UsernameController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }
    
    function IndexUsernameInput(){
        return view('page.username-input');
    }

    function PostUsernameInput(Request $request){
        dd($request);
    }
}
