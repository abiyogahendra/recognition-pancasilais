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
            $update_user = DB::table('user')
                ->where('id_user', '=', $request->id_username)
                ->update([
                    'clean_step' => 2
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
                }
                $tweet[$i] = explode("', '", $tweet[$i]);
                $final = json_encode($tweet[$i]);

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
