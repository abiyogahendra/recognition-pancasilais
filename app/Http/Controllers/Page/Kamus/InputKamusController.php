<?php

namespace App\Http\Controllers\Page\Kamus;

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

class InputKamusController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }

    function IndexInputKamus(){
        return view('kamus.input-kamus');
    }

    function ProcessInputKamus(Request $request){
        $data =   trim($request->data_kamus, '"' );
        $tweet = explode('", "', $data);
        

        foreach($tweet as $d){
            $check = DB::table('kamus_negative')
                ->where('data', '=', $d)
                ->count();
            if($check == 0){
                $insert = DB::table('kamus_negative')
                    ->insert([
                        'data' => $d
                    ]);
            }
        }
        return response()->json([
            'code' => 200
        ]);
    }

    function ProcessInputKamusPancasilais(Request $request){
        $check_data  = DB::table('kamus_pancasilais')
            ->where('data', '=', $request->data_kamus)
            ->count();
            
            if($check_data > 0){
                return response()->json([
                   'code'       => 500,
                   'message'    => 'data ' . $request->data_kamus . ' sudah ada !',
                ]);
            }else{
                $data_kamus_insert = DB::table('kamus_pancasilais')
                    ->insert([
                        'data' => $request->data_kamus
                    ]);
                return response()->json([
                    'code'      => 200,
                    'message'    => 'data ' . $request->data_kamus . ' sudah dinputkan',
                    ]);    
            }
    }

    function ProcessInputKamusNegative(Request $request){
        $data_negative = DB::table('kamus_negative')
            ->pluck('data');
        // dd($data_negative);
        // $data =   trim($request->data_kamus, '"' );
        // $tweet = explode('", "', $data);
        // $tweet = 'anjing';
        // $people = array("Peter", "Joe", "Glenn", "Cleveland");
        // dd($data_negative[0]->data);
        // dd($data_negative->toArray());

        // foreach($tweet as $i=>$d){
            if(!in_array($request->data_kamus,$data_negative->toArray())){
               $input = DB::table('kamus_negative')
                    ->insert([
                        'data'  => $request->data_kamus
                    ]);
                return response()->json([
                    'code'      => 200,
                    'message'    => 'data ' . $request->data_kamus . ' sudah dinputkan',
                    ]);
            } else{
                return response()->json([
                    'code'       => 500,
                    'message'    => 'data ' . $request->data_kamus . ' sudah ada !',
                 ]);
            }     
        // }
        // dd('an');
    
    }
}
