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
    // dd(request()->file_import_db);
        // Excel::import(new CleanTextImport,request()->file('file_import_db'));
        Excel::import(new CleanTextImport,request()->file_import_db);
        // (new CleanTextImport)->import(request()->file('file_import_db'), null, \Maatwebsite\Excel\Excel::XLSX);
                
        

    }

    
}
