<?php

namespace App\Http\Controllers\Page;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use split;
use Carbon\Carbon;

class PreprocessingController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }
    
    function IndexPreprocessingInput(){
        return view('page.preprocessing-input');
    }

    function PostPreprocessingInput(Request $request){
        $data_file = $request->file('file_preprocessing');
        
        $name = $data_file->getClientOriginalName();

        $username = explode('.', $name, 2);

        // dd($username);
        $update_step = DB::table('user')
            ->where('username', 'like', $username[0])
            ->update([
                'step' => 1
            ]);

        $upload_data = DB::table('preprocessing')
            ->insert([
                
            ]);
        // dd($name);
        
    }
}
