<?php

namespace App\Http\Controllers\Page\ImportDB;

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

class PrepareDataToReadyProcessController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }

    function IndexDataReady(){
        return view('page.prepare-data-to-ready-process');

    }

    function ListDataToReadyProcess(){
        $d = DB::table('clean_tweet')
            ->join('user', 'clean_tweet.id_user', '=', 'user.id_user')
            ->select([
                'user.id_user',
                'user.username',
                'clean_tweet.updated_at',
                DB::Raw('count(clean_tweet) as j_clean')
            ])
            ->groupBy([
                'user.id_user',
                'user.username',
                'clean_tweet.updated_at',
            ])
            ->get();

        $h = 0;
        $date = [];

        foreach($d as $q){
            $date[$h] = date('d-M-H:i', strtotime( $q->updated_at));
            $h++;
        }
        
        $i = 0;
        $data = [];

        foreach($d as $s){
            $data[$i] = [
                $s->id_user,
                $s->username,
                $s->j_clean,
                $date[$i],
            ];
            $i++;
        }

        return response($data);
        
    }

    function ProcessDataToReadyProcess(Request $request){

        $id = $request->id_username;
        $check = DB::table('data_ready')
            ->where('id_user', '=', $id)
            ->count();

        if($check == 0){
            $username = DB::table('user')
                ->where('id_user', '=', $request->id_username)
                ->select([
                    'username'
                ])
                ->get();

            
            $data_db = DB::table('clean_tweet')
                ->where('id_user', '=', $request->id_username)
                ->select([
                    'id_clean',
                    'clean_tweet'
                ])
                ->get();

            // dd($data_db);
            $i = 0;
            $tweet = [];
            foreach($data_db as $q){
                $tweet[$i] = trim($q->clean_tweet, "[]");
                $tweet[$i] = trim($tweet[$i], "'");

                if($tweet[$i] == "" ){
                    $delete = DB::table('clean_tweet')
                        ->where('id_clean', '=', $q->id_clean)
                        ->delete();
                }
                $tweet[$i] = explode("', '", $tweet[$i]);
                $final = json_encode($tweet[$i]);
                //  dd($final);

                $insert_ready_data = DB::table('data_ready')
                    ->insert([
                        'id_user'       => $request->id_username,
                        'ready_data' => json_encode($tweet[$i]),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                $i++;
            }
            
            return response()->json([
                'code' => 200,
                'data' => $i
            ]);
        }else{
            return response()->json([
                'code' => 500
            ]);
        }
        
    }
    




    
}
