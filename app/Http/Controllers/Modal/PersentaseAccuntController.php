<?php

namespace App\Http\Controllers\Modal;

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

class PersentaseAccuntController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }

    function ModalAccuntPersentase(Request $request){
        // dd($request);
        $check_data = DB::table('user')
            ->where('id_user', $request->kode_ss)
            ->select([
                'step',
            ])
            ->get();
        
        // default
        $pelabelan_netral = 0;
        $pelabelan_negative = 0;
        $pelabelan_pancasilais = 0;

        $final_pancasilais = 0;
        $final_netral = 0;
        $final_negative = 0;


        // get persentasi pelabelan
        if($check_data[0]->step == 4){
            $jumlah_data = DB::table('pelabelan')
                ->where('id_user', $request->kode_ss)
                ->count();
            $jumlah_pancasilais = DB::table('pelabelan')
                ->where('id_user', $request->kode_ss)
                ->where('klasifikasi','pancasilais')
                ->count();
            $jumlah_negative = DB::table('pelabelan')
                ->where('id_user', $request->kode_ss)
                ->where('klasifikasi','negative')
                ->count();
            $jumlah_netral = DB::table('pelabelan')
                ->where('id_user', $request->kode_ss)
                ->where('klasifikasi','netral')
                ->count();
            $pelabelan_netral = $jumlah_netral / $jumlah_data * 100;
            $pelabelan_netral = round($pelabelan_netral, 0);
            $pelabelan_negative = $jumlah_negative / $jumlah_data * 100;
            $pelabelan_negative = round($pelabelan_negative, 0);
            $pelabelan_pancasilais = $jumlah_pancasilais / $jumlah_data * 100;
            $pelabelan_pancasilais = round($pelabelan_pancasilais, 0);
        }elseif($check_data[0]->step == 7){
            // pelabelan
            $jumlah_data = DB::table('pelabelan')
                ->where('id_user', $request->kode_ss)
                ->count();
            $jumlah_pancasilais = DB::table('pelabelan')
                ->where('id_user', $request->kode_ss)
                ->where('klasifikasi','pancasilais')
                ->count();
            $jumlah_negative = DB::table('pelabelan')
                ->where('id_user', $request->kode_ss)
                ->where('klasifikasi','negative')
                ->count();
            $jumlah_netral = DB::table('pelabelan')
                ->where('id_user', $request->kode_ss)
                ->where('klasifikasi','netral')
                ->count();

            $pelabelan_netral = $jumlah_netral / $jumlah_data * 100;
            $pelabelan_netral = round($pelabelan_netral, 0);
            $pelabelan_negative = $jumlah_negative / $jumlah_data * 100;
            $pelabelan_negative = round($pelabelan_negative, 0);
            $pelabelan_pancasilais = $jumlah_pancasilais / $jumlah_data * 100;
            $pelabelan_pancasilais = round($pelabelan_pancasilais, 0);

            $klasifikasi = DB::table('data_final')
                ->where('id_user', $request->kode_ss)
                ->count();

            $jumlah_pancasilais_klasifikasi = DB::table('data_final')
                ->where('id_user', $request->kode_ss)
                ->where('class','pancasilais')
                ->count();
            $jumlah_negative_klasifikasi = DB::table('data_final')
                ->where('id_user', $request->kode_ss)
                ->where('class','negative')
                ->count();
            $jumlah_netral_klasifikasi = DB::table('data_final')
                ->where('id_user', $request->kode_ss)
                ->where('class','netral')
                ->count();
            
            $final_pancasilais = $jumlah_pancasilais_klasifikasi / $klasifikasi * 100;
            $final_pancasilais = round($final_pancasilais, 0);
            $final_netral = $jumlah_netral_klasifikasi / $klasifikasi * 100;
            $final_netral = round($final_netral, 0);
            $final_negative = $jumlah_negative_klasifikasi / $klasifikasi * 100;
            $final_negative = round($final_negative, 0);

        }
        return view('model.persentase-klasifikasi', compact(
            'pelabelan_netral',
            'pelabelan_negative',
            'pelabelan_pancasilais',
            'final_pancasilais',
            'final_netral',
            'final_negative',

        ));
    }
    

}
