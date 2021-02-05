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

class ProcessPreprocessingController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }
    
    function IndexProcessPreprocessing(){
        return view('page.preprocessing-process');
    }
    
    function DataProcessPreprocessing(){
        $d = DB::table('preprocessing')
            ->select([
                'user.id_user',
                'user.username',
                'preprocessing.id_preprocessing',
                'preprocessing.status',
                'preprocessing.updated_at',
            ])
            ->join('user', 'preprocessing.id_user', '=', 'user.id_user')
            ->get();

        $h = 0;
        $date = [];
        $step = []; 

        foreach($d as $q){
            $date[$h] = date('d-M-H:i', strtotime( $q->updated_at));

            if($q->status == 0){
                $step[$h] = 'Belum Terproses';
            }elseif($q->status == 1){
                $step[$h] = 'Sudah Terprocess';
            }
            $h++;
        }
        
        $i = 0;
        $data = [];

        foreach($d as $s){
            $data[$i] = [
                $s->id_preprocessing,
                $s->username,
                $step[$i],
                $date[$i],
            ];
            $i++;
        }

        return response($data);
    }

    function ProcessPreprocessing(Request $request){
        // dd($request);
        $username = DB::table('preprocessing')
            ->where('preprocessing.id_preprocessing', '=', $request->id_preprocessing)
            ->join('user', 'preprocessing.id_user', '=', 'user.id_user')
            ->select([
                'user.username',
                'preprocessing.id_preprocessing',
                'preprocessing.id_user'
            ])
            ->get();
        
        $update_status = DB::table('preprocessing')
            ->where('id_preprocessing', '=', $username[0]->id_preprocessing)
            ->update([
                'status' => 1
            ]);

        $update_step = DB::table('user')
            ->where('id_user', '=', $username[0]->id_user)
            ->update([
                'step' => 1
            ]);
        
        $final_username = 'preprocessing/' . $username[0]->username .'';
        // dd($final_username);
        $data = exec('py preprocessing\preprocessing.py '.$final_username .' 2>&1');
        
        return response()->json([
            'code' => 200,
            'file_name' => $username[0]->username . ".csv"
        ]);

    }

}
