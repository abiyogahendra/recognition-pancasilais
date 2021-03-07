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

    function CheckDataImport(Request $request){
        // dd($request);
        $check_data = DB::table('clean_tweet')
            ->where('id_user', '=', $request->id_user)
            ->count();
        // dd($check_data);
        if($check_data == 0){
            return response()->json([
                'code' => 200
            ]);
        }else{
            return response()->json([
                'code' => 500
            ]);
        }
    }

    function CheckDataReady(Request $request){
        $check_data = DB::table('clean_tweet')
            ->where('id_user', '=', $request->id_username)
            ->count();
        // dd($request->id_username);
        if($check_data == 0){
            return response()->json([
                'code' => 500
            ]);
        }else{
            return response()->json([
                'code' => 200
            ]);
        }
    }

    function ProcessDataToReadyProcess(Request $request){
        $check = DB::table('data_ready')
            ->where('id_user', '=', $request->id_username)
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
            $update_user = DB::table('user')
                ->where('id_user', '=', $request->id_username)
                ->update([
                    'step'          => 3,
                    'clean_step'    => 2
                ]);
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
                }else{
                    $tweet[$i] = explode("', '", $tweet[$i]);
                    $final = json_encode($tweet[$i]);

                    $insert_ready_data = DB::table('data_ready')
                        ->insert([
                            'id_user'       => $request->id_username,
                            'ready_data' => json_encode($tweet[$i]),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                }
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
