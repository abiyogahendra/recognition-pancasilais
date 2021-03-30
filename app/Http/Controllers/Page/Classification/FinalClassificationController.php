<?php

namespace App\Http\Controllers\Page\Classification;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use split;
use Response;
use Carbon\Carbon;
use App\Exports\TweetExport;
use Excel;
class FinalClassificationController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }
    
    function IndexFinalClassification(){

        return view('klasifikasi.final-classification');
    }
    
    function DataFinalClassification(){
        $d = DB::table('user')
            ->where('step', '>', 4)
            ->where('step', '<', 7)
            ->select([
                'id_user',
                'username',
                'step',
                'updated_at',
            ])
            ->get();

        $h = 0;
        $date = [];
        $step = []; 

        foreach($d as $q){
            $date[$h] = date('d-M-H:i', strtotime( $q->updated_at));

            if($q->step == 5){
                $step[$h] = 'Get Data';
            }elseif($q->step == 6){
                $step[$h] = 'Preprocessing';
            }elseif($q->step == 7){
                $step[$h] = 'Terklasifikasi';
            }
            $h++;
        }
        
        $i = 0;
        $data = [];

        foreach($d as $s){
            $data[$i] = [
                $s->id_user,
                $s->username,
                $step[$i],
                $date[$i],
            ];
            $i++;
        }
        return response($data);
    }

    function GetDataFromDataTweet(Request $request){
        // dd($request->username);
        $check_data = DB::table('user')
            ->where('username', 'like', $request->username)
            ->count();

        if($check_data > 0 ){
            
            $update_data_user = DB::table('user')  
                ->where('username', 'like', $request->username)
                ->update([
                    'step'  => 5
                ]);
            
            return response()->json([
                'code'      => 200,
                'message'   => 'Username ' . $request->username .  ' Sudah Didapatkan',
            ]);
        }else{
            return response()->json([
                'code'      => 500,
                'message'   => 'User ' . $request->username . ' Tidak Ditemukan',
            ]);
        }
    }

    function PreprocessingFinalClassification(Request $request){
        // dd($request->id_user);

        $check = DB::table('data_ready')
            ->where('id_user' ,'=', $request->id_user)
            ->count();
        $check_on_final = DB::table('data_final')
            ->where('id_user', '=', $request->id_user)
            ->count();
        if($check > 0 && $check_on_final == 0){
            $data = DB::table('pelabelan')
                ->where('pelabelan.id_user', '=', $request->id_user)
                ->join('data_ready', 'pelabelan.id_data_ready', '=', 'data_ready.id_data_ready')
                ->where('pelabelan.id_user', '=', $request->id_user)
                ->select([
                    'data_ready.id_user',
                    'data_ready.id_data_ready',
                    'data_ready.ready_data',
                    'pelabelan.klasifikasi'
                ])
                ->get();
            // dd($data);

            foreach($data as $q){
                $insert_ready_data = DB::table('data_final')
                    ->insert([
                        'id_user'       => $request->id_user,
                        'data'          => $q->ready_data,
                        'id_data_ready' => $q->id_data_ready,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ]);
            }

            // check data 
                $new_data = DB::table('data_final')
                    ->where('id_user', $request->id_user)
                    ->get();
                
                foreach($new_data as $d){
                    $array = json_decode($d->data , true);
                    $data_baru = [];
                    $g = 0;
                    foreach($array as $f){
                        if(strlen($f) != 2 && !strpos($f, "wkwk")){
                            $data_baru[$g] = $f;
                            $g++;
                        }
                    }
                    $array = json_encode($data_baru);
                    $update_new_data = DB::table('data_final')
                        ->where('id_data_ready', $d->id_data_ready)
                        ->update([
                            'data'  => $array
                        ]);
                }

            $update_user = DB::table('user')
                ->where('id_user', '=', $request->id_user)
                ->update([
                    'step' => 6
                ]);

            return response()->json([
                'code' => 200,
                'message' => 'Lanjutkan Untuk Melakukan Klasifikasi'
            ]);    

        }else{
            return response()->json([
                'code' => 500,
                'message' => 'Terjadi masalah dalam melakukan preprocessing'
            ]);
        }

    }

    function ProcessFinalDataClassification(Request $request){

        $check_data = DB::table('data_final')
            ->where('id_user', '=', $request->id_user)
            ->count();
        if($check_data > 0){
            // menghitung jumlah dataset keseluruhan tanpa ada kesamaan
                $jumlah_dataset_pancasilais = DB::table('dataset_pancasilais')
                    ->count();

                $jumlah_dataset_negative = DB::table('dataset_negative')
                    ->count();
                    
                $jumlah_dataset_netral = DB::table('dataset_netral')
                    ->count();
            // jumlah seluruh data set yang ada dalam data pelabelan dengan parameter perkata
                $jumlah_dataset = $jumlah_dataset_pancasilais + $jumlah_dataset_negative + $jumlah_dataset_netral;         
              
            //  menghitung jumlah doc
                $doc = DB::table('pelabelan')
                    // ->where('klasifikasi','pancasilais')
                    // ->orWhere('klasifikasi', 'negative')
                    ->count();

            // menghitung probabilitas class pancasilais;
                $doc_pancasilais = DB::table('pelabelan')
                    ->where('klasifikasi', '=', 'pancasilais')
                    ->count();
            
                $probability_class_pancasilais = $doc_pancasilais / $doc;

            // menghitung probabilitas class negative;
                $doc_negative = DB::table('pelabelan')
                    ->where('klasifikasi', '=', 'negative')
                    ->count();
                
                $probability_class_negative = $doc_negative / $doc;

            // menghitung probabilitas class negative;
                $doc_netral = DB::table('pelabelan')
                    ->where('klasifikasi', '=', 'netral')
                    ->count();
                
                $probability_class_netral = $doc_netral / $doc;

            // dataset pancasilais, negative, netral
                $dataset_pancasilais = DB::table('dataset_pancasilais')
                    ->select('data')
                    ->get();

                $dataset_negative = DB::table('dataset_negative')
                    ->select('data')
                    ->get();
                    
                $dataset_netral = DB::table('dataset_netral')
                    ->select('data')
                    ->get();
            // data final 
                $data_final_pancasilais = DB::table('data_final')
                    ->where('id_user', '=', $request->id_user)
                    ->select([
                        'id_data_final',
                        'data'
                    ])
                    ->get();
                
            // perhitungan probability pancasilais
                $i = 0;
                $probabilitas_kata_pancasilais = [];
                $probabilitas_kata_negative = [];
                $probabilitas_kata_netral = [];
                foreach($data_final_pancasilais as $d){
                    $tmp = 0;
                    $tmp = json_decode($d->data, true);
                    $tmp_p = 0;
                    $tmp_n = 0;
                    $tmp_netral = 0;
                    // dd($tmp); 
                    $jumlah_pro_pancasilais = 1;
                    $jumlah_pro_negative = 1;
                    $jumlah_pro_netral = 1;

                    foreach($tmp as $f){
                         // mulai perhitungan probability pancasilais
                            foreach($dataset_pancasilais as $kamus){
                                if($f == $kamus->data){
                                    $tmp_p = $tmp_p + 1; 
                                }
                            }
                                $pembagi_p = $jumlah_dataset_pancasilais  + $jumlah_dataset;
                                $probabilitas_kata_pancasilais[$i] = ($tmp_p + 1) / $pembagi_p;
                                $jumlah_pro_pancasilais = $jumlah_pro_pancasilais * $probabilitas_kata_pancasilais[$i];

                        // mulai perhitungan probability Negative
                            foreach($dataset_negative as $kam){
                                if($f == $kam->data){
                                    $tmp_n = $tmp_n + 1; 
                                }
                            }
                            
                            $pembagi_neg = $jumlah_dataset_negative + $jumlah_dataset;
                            $probabilitas_kata_negative[$i] = ($tmp_n + 1) / $pembagi_neg;
                            $jumlah_pro_negative = $jumlah_pro_negative * $probabilitas_kata_negative[$i];

                        // mulai perhitungan probability netral
                            foreach($dataset_netral as $net){
                                if($f == $net->data){
                                    $tmp_netral = $tmp_netral + 1; 
                                }
                            }
                            
                            $pembagi_net = $jumlah_dataset_netral + $jumlah_dataset;
                            $probabilitas_kata_netral[$i] = ($tmp_netral + 1) / $pembagi_net;
                            $jumlah_pro_netral = $jumlah_pro_netral * $probabilitas_kata_netral[$i];
                            $i++;

                    }
                        
                        // mulai klasifikasi pertweet
                            $perhitungan_final_pancasilais =  $jumlah_pro_pancasilais * $probability_class_pancasilais * 100000000000000000;
                            $perhitungan_final_negative =  $jumlah_pro_negative * $probability_class_negative * 100000000000000000;
                            $perhitungan_final_netral =  $jumlah_pro_netral * $probability_class_netral * 100000000000000000;

                            // dd($perhitungan_final_pancasilais);

                        if($perhitungan_final_pancasilais > $perhitungan_final_negative && $perhitungan_final_pancasilais > $perhitungan_final_netral ){
                            $update_class_pancasilais = DB::table('data_final')
                                ->where('id_data_final', '=', $d->id_data_final)
                                ->update([
                                    'class'     => 'pancasilais'
                                ]);

                        }elseif($perhitungan_final_negative > $perhitungan_final_pancasilais && $perhitungan_final_negative > $perhitungan_final_netral){
                            $update_class_negative = DB::table('data_final')
                            ->where('id_data_final', '=', $d->id_data_final)
                            ->update([
                                'class'     => 'negative'
                            ]);    
                        }elseif($perhitungan_final_netral > $perhitungan_final_pancasilais && $perhitungan_final_netral > $perhitungan_final_negative){
                            $update_class_netral = DB::table('data_final')
                            ->where('id_data_final', '=', $d->id_data_final)
                            ->update([
                                'class'     => 'netral'
                            ]);
                        }
                }

                $update_user = DB::table('user')
                    ->where('id_user', '=', $request->id_user)
                    ->update([
                        'step' => 7
                    ]);
            // end pancasilais
                return response()->json([
                    'code'      => 200,
                    'message'   => 'Data Selesai Terklasifikasi'
                ]);
            // dd($data_final_pancasilais);
        }else{
            return response()->json([
                'code'      => 500,
                'message'   => 'Mohon melakukan preprocessing terlebih dahulu'
            ]);
        }


    } 


    function CustomData(){
        ////////
        // $user = DB::table('user')
        //     ->get();

        // foreach($user as $d){
        //     $update = DB::table('user')
        //         ->where('id_user', $d->id_user)
        //         ->update([
        //             'step'          => 0,
        //             'clean_step'    => 0,
        //             'label_step'    => 0,
        //             'class'         => 'belum'
        //         ]);
        // }


        /////////


        // $delete = DB::table('data_final')
        //     ->where('id_user', '=', '295')
        //     ->delete();



        // Excel::store(new  TweetExport(224),'@aaaaaaaaaa.xlsx', 'preprocessing');
        // $data_set = DB::table('pelabelan')
        //     ->join('data_ready', 'pelabelan.id_data_ready', '=', 'data_ready.id_data_ready')
        //     ->select([
        //         'data_ready.ready_data',
        //     ])
        //     ->get();

        // $i = 0;
        // $dt_awal = [];
        // foreach($data_set as $d){
        //     $dt_awal[$i] = json_decode($d->ready_data, true);
        //     $i++;
        // }
        
        // $i = 0;
        // $dt_kedua = [];
        // foreach($dt_awal as $d){
        //     foreach($d as $f){
        //         // dd($f);
        //         if(!in_array($f,$dt_kedua)){
        //             $dt_kedua[$i] = $f;
        //             $i++;
        //         }
        //     }
        // }

        // asort($dt_kedua);
        // foreach($dt_kedua as $d){
        //     $insert_data = DB::table('tmp_dataset')
        //         ->insert([
        //             'data'  => $d
        //         ]);
        // }



        // input dataset 

        // pengambilan data dari data pancasilais
        $data_set_pancasilais = DB::table('pelabelan')
            ->where('pelabelan.klasifikasi', '=', 'pancasilais')
            ->join('data_ready', 'pelabelan.id_data_ready', '=', 'data_ready.id_data_ready')
            ->select([
                'data_ready.id_data_ready',
                'data_ready.ready_data',
                'pelabelan.klasifikasi',
            ])
            ->get();
            
        $tmp = 0;
        
        foreach($data_set_pancasilais as $d){
            $tmp =  json_decode($d->ready_data, true);
            foreach($tmp as $f){
                $insert_dataset_pancasilais = DB::table('dataset_pancasilais')
                    ->insert([
                        'data'          => $f,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ]);
            }
        }

        $data_set_negative = DB::table('pelabelan')
            ->where('pelabelan.klasifikasi', '=', 'negative')
            ->join('data_ready', 'pelabelan.id_data_ready', '=', 'data_ready.id_data_ready')
            ->select([
                'data_ready.id_data_ready',
                'data_ready.ready_data',
                'pelabelan.klasifikasi',
            ])
            ->get();
        // dd($data_set_negative);

        $tmp = 0;
        foreach($data_set_negative as $d){
            $tmp =  json_decode($d->ready_data, true);
            foreach($tmp as $f){
                $insert_dataset_negative = DB::table('dataset_negative')
                    ->insert([
                        'data'          => $f,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ]);
            }
        }   
        
        
        $data_set_netral = DB::table('pelabelan')
            ->where('pelabelan.klasifikasi', '=', 'netral')
            ->join('data_ready', 'pelabelan.id_data_ready', '=', 'data_ready.id_data_ready')
            ->select([
                'data_ready.id_data_ready',
                'data_ready.ready_data',
                'pelabelan.klasifikasi',
            ])
            ->get();
        // dd($data_set_negative);

        $tmp = 0;
        foreach($data_set_netral as $d){
            $tmp =  json_decode($d->ready_data, true);
            foreach($tmp as $f){
                $insert_dataset_netral = DB::table('dataset_netral')
                    ->insert([
                        'data'          => $f,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ]);
            }
        }   

        return response()->json([
            'code'      => 200,
            'message'   => 'Data Tweet sudah Terklasifikasi'
        ]);
        

    }
}
