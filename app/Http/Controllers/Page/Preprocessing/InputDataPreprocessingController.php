<?php

namespace App\Http\Controllers\Page\Preprocessing;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use split;
use Carbon\Carbon;

class InputDataPreprocessingController extends Controller{
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

        $data_file->move('preprocessing/',$name);

        $username = explode('.', $name, 2);
        // dd($username);
        $update_step = DB::table('user')
            ->where('username', 'like', $username[0])
            ->update([
                'step' => 1
            ]);
        $get_id_user = DB::table('user')
            ->where('username', 'like', $username[0])
            ->select(['id_user'])
            ->get();

        $upload_data = DB::table('preprocessing')
            ->insert([
                'id_user' => $get_id_user[0]->id_user,
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        return response()->json([
            'code' => 200,
            'file_name' => $name
        ]);
    }
}
