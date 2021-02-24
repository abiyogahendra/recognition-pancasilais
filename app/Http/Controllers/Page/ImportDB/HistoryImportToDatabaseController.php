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
        return view('page.history-import-database');
    }
    
    function dataHistoryImportDB (){
       $clean_tweet = DB::table('user')
       ->where('step', '>', 0 )
        ->join('dt_tw', 'user.id_user', '=', 'dt_tw.id_user')
        ->select([
            'user.id_user',
            'user.username',
            'user.clean_step',
            DB::Raw('count(tweet) as clean_tweet'),
            'user.updated_at'
        ])
        ->groupBy([
            'user.id_user',
            'user.username',
            'user.clean_step',
            'user.updated_at'
        ])
        ->get();
        
        $h = 0;
        $date = [];
        $step = []; 

        foreach($clean_tweet as $q){
            $date[$h] = date('d-M-H:i', strtotime( $q->updated_at));

            if($q->clean_step == 0){
                $step[$h] = 'Belum Terimport';
            }else if($q->clean_step == 1){
                $step[$h] = 'Belum Bersih';
            }else{
                $step[$h] = 'Data Ready';
            }
            $h++;
        }

        $i = 0;
        $data = [];
        foreach($clean_tweet as $q){
            $data[$i] = [
                $q->id_user,
                $q->username,
                $q->clean_tweet,
                $step[$i],
                $date[$i]
            ];
            $i++;
        }

        return response($data);
    }

    
}
