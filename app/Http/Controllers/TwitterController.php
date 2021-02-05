<?php

namespace App\Http\Controllers;

use App\Exports\TweetExport;
use Twitter;
use Illuminate\Http\Request;
use DB;
use App\Models\Tweet;
use Carbon\Carbon;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class TwitterController extends Controller
{
    //
    function GetData(Request $request){
        
        // $screen_name = 'arsiimam';
        
        // $data = Twitter::getUserTimeline([
        //     'screen_name'   => $screen_name, 
        //     'count'         => 20, 
        //     'format'        => 'object'
        // ]);
        
        // $upload_user = DB::table('user')
        // ->insert([
        //     'username'      => $screen_name,
        //     'created_at'    => Carbon::now(),
        //     'updated_at'    => Carbon::now()
        //     ]);
            
        //     $user = DB::table('user')
        //     ->orderByRaw('created_at DESC')
        //     // ->select([
        //     //     ''
        //     // ])
        //     ->get()
        //     ->first();

        // foreach($data as $d){
        //     $upload_data = DB::table('dt_tw')
        //     ->insert([
        //         'id_user'   =>  $user->id_user,
        //         'tweet'     =>  $d->text
        //     ]);
        // }

        // $uji = DB::table('dt_tw')
        //     ->delete();

       $out = 'preprocessing/arsiimam';
       $data = exec('py preprocessing\preprocessing.py '. $out.' 2>&1');

       echo $data;
       
       
       
       
        // dd($user);
        // $process = new Process(['python/python']);
        // // $process = new Process("python3 /preprocessing/preprocessing.py \data_arsi.cs");
        // $process->run();
        
        // // executes after the command finishes
        // if (!$process->isSuccessful()) {
        //     throw new \RuntimeException($process->getErrorOutput());
        // }
        
        // print $process->getOutput();
        
    }

    
}
