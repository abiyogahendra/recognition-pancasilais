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

       $jumlah_data_training = DB::table('pelabelan')
            ->select([
                'id_pelabelan',
            ])
            ->count();
        $training_pancasilais = DB::table('pelabelan')
                ->where('klasifikasi','pancasilais')
                ->count();
        $training_negative = DB::table('pelabelan')
                ->where('klasifikasi','negative')
                ->count();
        $training_netral = DB::table('pelabelan')
                ->where('klasifikasi','netral')
                ->count();
        
        $persentasi_pancasilais_training = $training_pancasilais / $jumlah_data_training * 100;
        $persentasi_negative_training = $training_negative / $jumlah_data_training * 100;
        $persentasi_netral_training = $training_netral / $jumlah_data_training * 100;
        
       
        $jumlah_data_keseluruhan = DB::table('data_final')
            ->select([
               'id_data_final' 
            ])
            ->count();
        
        $j_pancasilais = DB::table('data_final')
            ->where('class', '=', 'pancasilais')
            ->count();

        $j_netral  = DB::table('data_final')
                ->where('class', '=', 'netral')
                ->count();
            
        $j_negative = DB::table('data_final')
                ->where('class', '=', 'negative')
                ->count();

        $persentase_pancasilais  = $j_pancasilais / $jumlah_data_keseluruhan * 100;
        $persentase_netral  = $j_netral / $jumlah_data_keseluruhan * 100;
        $persentase_negative  = $j_negative / $jumlah_data_keseluruhan * 100;


        // metode Confusion Matrix

        $list_user_klasifikasi = DB::table('user')
            ->where('user.step', '=', '7')
            ->join('pelabelan', 'user.id_user', '=', 'pelabelan.id_user')
            ->select([
                'pelabelan.id_data_ready',
                'pelabelan.klasifikasi',
            ])
            ->get();

        // $list_user_klasifikasi = DB::table('pelabelan')
        //     ->where('pelabelan.klasifikasi','pancasilais')
        //     ->orWhere('pelabelan.klasifikasi','negative')
        //     ->join('data_final', 'pelabelan.id_data_ready', '=', 'data_final.id_data_ready')
        //     ->select([
        //         'pelabelan.id_data_ready',
        //         'pelabelan.klasifikasi',
        //     ])
        //     ->get();

        $true_pancasilais = 0;
        $true_negative = 0;
        $true_netral = 0;
        $false_pancasilais = 0;
        $false_negative = 0;
        $false_netral = 0;
        $false_recall_pancasilais = 0;
        $false_recall_negative = 0;
        $false_recall_netral = 0;
        foreach($list_user_klasifikasi as $d){
            
            $get_data_final = DB::table('data_final')
            ->where('id_data_ready', '=', $d->id_data_ready)
            ->select([
                'id_data_ready',
                'class'
            ])
            ->get();
            if($d->klasifikasi == "pancasilais"){
                if($get_data_final[0]->class == "pancasilais"){
                    $true_pancasilais = $true_pancasilais + 1;
                }elseif($get_data_final[0]->class == "negative"){
                    $false_pancasilais = $false_pancasilais + 1;
                    $false_recall_negative = $false_recall_negative + 1;
                }elseif($get_data_final[0]->class == "netral"){
                    $false_pancasilais = $false_pancasilais + 1;
                    $false_recall_netral = $false_recall_netral + 1;
                }
            }elseif($d->klasifikasi == "negative"){
                if($get_data_final[0]->class == "negative"){
                    $true_negative = $true_negative + 1;
                }elseif($get_data_final[0]->class == "pancasilais"){
                    $false_negative = $false_negative + 1;
                    $false_recall_pancasilais = $false_recall_pancasilais + 1;
                }elseif($get_data_final[0]->class == "netral"){
                    $false_negative = $false_negative + 1;
                    $false_recall_netral = $false_recall_netral + 1;
                }
            }
            elseif($d->klasifikasi == "netral"){
                if($get_data_final[0]->class == "netral"){
                    $true_netral = $true_netral + 1;
                }elseif($get_data_final[0]->class == "pancasilais"){
                    $false_netral = $false_netral + 1;
                    $false_recall_pancasilais = $false_recall_pancasilais + 1;
                }elseif($get_data_final[0]->class == "negative"){
                    $false_netral = $false_netral + 1;
                    $false_recall_negative = $false_recall_negative + 1;
                }
                
            }
        }
        // dd($false_netral);
        $tp_tn_tn = $true_pancasilais + $true_negative + $true_netral;
        dd($tp_tn_tn);
        // $tp_tn_tn = $true_pancasilais + $true_negative ;
        $tp_fp_tn_fn = $true_pancasilais + $false_pancasilais + $true_negative + $false_negative + $true_netral + $false_netral ;
        // $tp_fp_tn_fn = $true_pancasilais + $false_pancasilais + $true_negative + $false_negative;
        $akurasi =  $tp_tn_tn / $tp_fp_tn_fn;
        

        // mencari presisi
            $jumlah_data_pancasilais = $true_pancasilais + $false_pancasilais;
            $presisi_pancasilais = $true_pancasilais / $jumlah_data_pancasilais;

            $jumlah_data_negative = $true_negative + $false_negative;
            $presisi_negative = $true_negative / $jumlah_data_negative;

            $jumlah_data_netral = $true_netral + $false_netral;
            $presisi_netral = $true_netral / $jumlah_data_netral;

            $jumlah_class = 3;
            $jumlah_semua_presisi_class = $presisi_pancasilais + $presisi_netral + $presisi_negative;
            // $jumlah_semua_presisi_class = $presisi_pancasilais + $presisi_negative;
            $presisi = $jumlah_semua_presisi_class / $jumlah_class;
        
        // mencari recall
            $jumlah_data_recall_pancasilais = $true_pancasilais + $false_recall_pancasilais;
            $recall_pancasilais = $true_pancasilais / $jumlah_data_recall_pancasilais;
            
            $jumlah_data_recall_negative = $true_negative + $false_recall_negative;
            $recall_negative = $true_negative / $jumlah_data_recall_negative;
            
            $jumlah_data_recall_netral = $true_netral + $false_recall_netral;
            $recall_netral = $true_netral / $jumlah_data_recall_netral;


        $jumlah_class_recall = $recall_pancasilais + $recall_negative + $recall_netral;
        // $jumlah_class_recall = $recall_pancasilais + $recall_negative;
        $jumlah_recall = 3;
        $recall = $jumlah_class_recall / $jumlah_recall;        

        return view('page.dashboard', compact(
            'persentasi_pancasilais_training',
            'persentasi_negative_training',
            'persentasi_netral_training',
            'persentase_pancasilais',
            'persentase_netral',
            'persentase_negative',
            'akurasi',
            'presisi',
            'recall',
        ));
    }
    
    function DataUser(){
        
        $data_user = DB::table('user')
            ->join('dt_tw', 'user.id_user', '=', 'dt_tw.id_user')
            ->select([
                'user.id_user',
                'user.username',
                'user.step',
                'user.class',
                DB::raw('count(tweet) as j_tweet'),
                'user.updated_at'
            ])
            ->groupBy([
                'user.id_user',
                'user.username',
                'user.step',
                'user.updated_at',
                'user.class',
            ])
            ->get();

            $h = 0;
            $date = [];
            $step = []; 
    
            foreach($data_user as $q){
                $date[$h] = date('d-M-H:i', strtotime( $q->updated_at));
    
                if($q->step == 0){
                    $step[$h] = 'Belum Terimport';
                }else if($q->step == 1){
                    $step[$h] = 'Preprocessing';
                }else if($q->step == 2){
                    $step[$h] = 'Preprocessing';
                }else if($q->step == 3){
                    $step[$h] = 'Preprocessing';
                }else if($q->step == 4){
                    $step[$h] = 'Data Ready';
                }else if($q->step == 5){
                    $step[$h] = 'Final Preprocessing';
                }else if($q->step == 6){
                    $step[$h] = 'Final Classification';
                }else if($q->step == 7){
                    $step[$h] = 'Final Classification';
                }

                $h++;
            }
    
            $i = 0;
            $data = [];
            foreach($data_user as $q){
                $data[$i] = [
                    $q->id_user,
                    $q->username,
                    $q->j_tweet,
                    $step[$i],
                    $q->class,
                    $date[$i]
                ];
                $i++;
            }
    
            return response($data);
    }

    function DeleteAllDataUser(Request $request){
        // dd($request);

        $delete_data_preprocessing = DB::table('preprocessing')
            ->where('id_user', '=', $request->id_user)
            ->delete();

        $delete_data_pelabelan = DB::table('pelabelan')
            ->where('id_user', '=', $request->id_user)
            ->delete();
        
        $delete_data_tweet = DB::table('dt_tw')
            ->where('id_user', '=', $request->id_user)
            ->delete();
        
        $delete_data_ready = DB::table('data_ready')
            ->where('id_user', '=', $request->id_user)
            ->delete();
        
        $delete_data_final = DB::table('data_final')
            ->where('id_user', '=', $request->id_user)
            ->delete();
        
        $delete_data_clean = DB::table('clean_tweet')
            ->where('id_user', '=', $request->id_user)
            ->delete();

        $delete_data_clean = DB::table('user')
            ->where('id_user', '=', $request->id_user)
            ->delete();
        
        return response()->json([
            'code' => 200,
            'message' => 'Data User Telah Terhapus'
        ]);

    }
}
