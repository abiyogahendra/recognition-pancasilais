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

class HistoryImportToDatabaseController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }

    function IndexHistoryImportDB(){
        return view('page.history-mining');
    }
    
    function DataHistoryMining(){
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

    
}
