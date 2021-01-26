<?php

namespace App\Http\Controllers;

use App\Exports\TweetExport;
use Twitter;
use Illuminate\Http\Request;
use DB;
use App\Models\Tweet;
use Carbon\Carbon;


class TwitterController extends Controller
{
    //
    function GetData(Request $request){
        
        $screen_name = 'arsiimam';
        
        $data = Twitter::getUserTimeline([
            'screen_name'   => $screen_name, 
            'count'         => 20, 
            'format'        => 'object'
        ]);
        
        $upload_user = DB::table('user')
        ->insert([
            'username'      => $screen_name,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
            ]);
            
            $user = DB::table('user')
            ->orderByRaw('created_at DESC')
            // ->select([
            //     ''
            // ])
            ->get()
            ->first();

        foreach($data as $d){
            $upload_data = DB::table('dt_tw')
            ->insert([
                'id_user'   =>  $user->id_user,
                'tweet'     =>  $d->text
            ]);
        }

        $uji = DB::table('dt_tw')
            ->delete();

        // dd($user);
        // return (new TweetExport($user->id_user))->download('data.csv');
    }

    
}
