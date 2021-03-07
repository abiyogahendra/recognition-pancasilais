<?php

namespace App\Http\Controllers\Page;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }
    
    function IndexDashboard(){

        $jumlah_data_keseluruhan = DB::table('pelabelan')
            ->select([
               'id_pelabelan' 
            ])
            ->count();
        
        $j_pancasilais = DB::table('pelabelan')
            ->where('klasifikasi', '=', 'pancasilais')
            ->count();

        $j_netral  = DB::table('pelabelan')
                ->where('klasifikasi', '=', 'netral')
                ->count();
            
        $j_negative = DB::table('pelabelan')
                ->where('klasifikasi', '=', 'negative')
                ->count();

        $persentase_pancasilais  = $j_pancasilais / $jumlah_data_keseluruhan * 100;
        $persentase_netral  = $j_netral / $jumlah_data_keseluruhan * 100;
        $persentase_negative  = $j_negative / $jumlah_data_keseluruhan * 100;

        // $update = DB::table('user')
        //     ->update([
        // //         'label_step'    => 0,
        // //         'step'          => 3
        //         'class'         => 0
        //     ]);
        return view('page.dashboard', compact(
            'persentase_pancasilais',
            'persentase_netral',
            'persentase_negative',
        ));
    }
}
