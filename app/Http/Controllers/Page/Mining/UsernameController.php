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

class UsernameController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }
    
    function IndexUsernameInput(){
        return view('page.username-input');
    }

    function PostUsernameInput(Request $request){
        
        $data = Twitter::getUserTimeline([
            'screen_name'   => $request->username, 
            'count'         => 20, 
            'format'        => 'object'
        ]);
        
        $upload_user = DB::table('user')
        ->insert([
            'username'      => $request->username,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
            ]);
            
            $user = DB::table('user')
            ->orderByRaw('created_at DESC')
            ->get()
            ->first();

        foreach($data as $d){
            $upload_data = DB::table('dt_tw')
            ->insert([
                'id_user'   =>  $user->id_user,
                'tweet'     =>  $d->text
            ]);
        }

        $user_data = DB::table('user')
            ->where('username','=',$request->username)
            ->first();

       
            
        if(isset($user_data)){
            $count_tweet = DB::table('dt_tw')
            ->where('id_user', '=', $user_data->id_user)
            ->count();
            
            return response()->json([
                'code' => 200,
                'tweet' => $count_tweet
            ]);
        }else{
            return response()->json([
                'code' => 500,
                'username' => $request->username
            ]);
        }

      
    }
}
