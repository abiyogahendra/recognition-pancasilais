<?php

namespace App\Http\Controllers;

use App\Exports\TweetExport;
use App\Imports\CleanTextImport;
use CleanText;
use Illuminate\Http\Request;
use DB;
use App\Models\Tweet;
use Carbon\Carbon;


class CleanTextController extends Controller
{
    //
    function UpdateCleanText(Request $request){
        
      dd($request);

        // dd($user);
        // return (new TweetExport($user->id_user))->download('data.csv');
    }

    function IndexCleanTextInput(){
        return view('page.clean-text-input');
    }
    
}
