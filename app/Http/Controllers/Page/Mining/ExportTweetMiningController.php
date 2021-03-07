<?php

namespace App\Http\Controllers\Page\Mining;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\TweetExport;
use App\Models\Tweet;
use Twitter;
use Validator;
use Auth;
use DB;
use Carbon\Carbon;
use Excel;

class ExportTweetMiningController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }

    function IndexExportMining(){
        return view('page.export-tweet-mining');
    }
    
    function DataExportMining(){
        $data_d = DB::table('user')
            ->join('dt_tw', 'user.id_user', '=', 'dt_tw.id_user')
            ->groupBy([
                'user.username',
                'user.id_user',
                'user.step',
                'user.updated_at',
                ])
            ->select([
                'user.id_user',
                'user.username',
                'user.step',
                'user.updated_at',
                DB::Raw('count(tweet) as j_tweet')
            ])
            ->get();
        $h = 0;        
        $step = []; 
        $update = [];       
        // dd($data_d);
        foreach($data_d as $s){
            $update[$h] = date('d-M-H:i', strtotime( $s->updated_at));

            if($s->step == 0){
                $step[$h] = 'Mining Data';
            }elseif($s->step == 1){
                $step[$h] = 'Preprocessing Data';
            }elseif($s->step == 2){
                $step[$h] = 'Convert To Database';
            }elseif($s->step == 3){
                $step[$h] = 'Recognition Data';
            }
            $h++;
        }


        $i = 0;
        $data = [];
        foreach($data_d as $q){
            $data[$i] = [
                $q->id_user,
                $q->username,
                $q->j_tweet,
                $step[$i],
                $update[$i]
            ];
            $i++;
        }
        return response($data);
    }

    function ExportDataTweet(Request $request){

        $data = DB::table('user')
            ->where('id_user', '=',$request->id_user)
            ->select([
                'username'
            ])
            ->get();
        
         Excel::store(new  TweetExport($request->id_user), $data[0]->username.'.csv', 'preprocessing');

         $update_step = DB::table('user')
            ->where('id_user', '=', $request->id_user)
            ->update([
                'step' => 1,
                'updated_at' => Carbon::now(),
            ]);

        $upload_data = DB::table('preprocessing')
            ->insert([
                'id_user' => $request->id_user,
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        $check_data = DB::table('preprocessing')
                ->where('id_user', '=', $request->id_user)
                ->count();
            
        if(isset($check_data)){
            return response()->json([
                'code'      => 200,
                'message'   => 'Data Berhasil Diexport'
            ]);
        }else{
             return response()->json([
                'code' => 300
            ]);
        }      
        // return (new TweetExport($id))->store($data[0]->username.'.csv', 'preprocessing');
    }
    
}
