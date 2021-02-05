<?php

namespace App\Http\Controllers\Page\Preprocessing;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use split;
use Response;
use Carbon\Carbon;

class HistoryPreprocessingController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }
    
    function IndexHistoryPreprocessing(){
        return view('page.history-preprocessing');
    }
    
    function DataHistoryPreprocessing(){
        $d = DB::table('preprocessing')
            ->select([
                'user.id_user',
                'user.username',
                'preprocessing.id_preprocessing',
                'preprocessing.status',
                'preprocessing.updated_at',
                DB::Raw('count(tweet) as j_tweet')
            ])
            ->join('user', 'preprocessing.id_user', '=', 'user.id_user')
            ->join('dt_tw', 'preprocessing.id_user', '=', 'dt_tw.id_user')
            ->groupBy([
                'user.id_user',
                'user.username',
                'preprocessing.id_preprocessing',
                'preprocessing.status',
                'preprocessing.updated_at',
            ])
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
                $s->j_tweet,
                $step[$i],
                $date[$i],
            ];
            $i++;
        }

        return response($data);
    }


    function ConfirmationDownloadFilePreprocession(Request $request){
        $check_status = DB::table('preprocessing')
            ->where('preprocessing.id_preprocessing', '=', $request->id_preprocessing)
            ->join('user', 'preprocessing.id_user', '=', 'user.id_user')
            ->select([
                'preprocessing.status',
                'user.username'
            ])
            ->get();
        // dd($check_status);
            if($check_status[0]->status > 0){
                return response()->json([
                    'code' => 200,
                    'file_name' => $check_status[0]->username . '.xlsx'
                ]);
            }else{
                return response()->json([
                    'code' => 500,
                ]);
            }
    }

    function DownloadFilePreprocession(Request $request, $file){
        // dd($file);
        $final  = '' . $file;
        // dd($final);
        $file_path = public_path()."\preprocessing\\" . $file;
        $headers = array('Content-Type: xlsx',);
        return Response::download($file_path, $file ,$headers);

    }
    
}
