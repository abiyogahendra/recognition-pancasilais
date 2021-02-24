<?php

namespace App\Http\Controllers\Page\ImportDB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\TweetExport;
use App\Imports\CleanTextImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Tweet;
use Twitter;
use Validator;
use Auth;
use DB;
use Carbon\Carbon;
use File;

class ImportToDatabaseController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }

    function IndexInputImportDatabase(){
        return view('page.import-data-to-database-input');
    }
    
    function DataInputImportDatabase(Request $request){    
        //    dd($request);
       
        $data_user = DB::table('user')
            ->where('id_user', '=', $request->id_user)
            ->select([
                'username'
            ])
            ->get();
        

        $filename = $data_user[0]->username .".xlsx";

        $files = File::files(public_path('/preprocessing'));

        foreach($files as $d){
            if($d->getFilename() == $filename){
                $data = $d;
            }
        }
        Excel::import(new CleanTextImport,$data);
        
        $checkData = DB::table('clean_tweet')
            ->where('id_user', '=', $request->id_user)
            ->count();
        
        if(isset($checkData)){

            $update_user_step = DB::table('user')
                ->where('id_user', '=', $request->id_user)
                ->update([
                    'clean_step' => 1
                ]);

            return response()->json([
                'code' => 200,
                'message' => 'Data ' . $data_user[0]->username . " Telah Berhasil Terimport"
            ]);
        }else{
            return response()->json([
                'code' => 300,
            ]);
        }
    }

    
}
