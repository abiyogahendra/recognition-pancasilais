<?php

namespace App\Http\Controllers\Page\Pelabelan;

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

class PelabelanController extends Controller{
    //
    public function __construct(){
        $this->middleware(['web']);
    }

    function IndexPelabelan(){
        return view('pelabelan.history-pelabelan');
    }

    function DataPelabelan(Request $request){
       $d = DB::table('user')
        ->where('user.step', '=', 3)
        ->join('data_ready', 'user.id_user', '=','data_ready.id_user')
        ->select([
            'user.id_user',
            'user.username',
            'user.label_step',
            'user.updated_at',
            DB::raw('count(ready_data) as j_data')
        ])
        ->groupBy([
            'user.id_user',
            'user.username',
            'user.label_step',
            'user.updated_at',
         ])
        ->get();

        $h = 0;
        $date = [];
        $step = []; 

        foreach($d as $q){
            $date[$h] = date('d-M-H:i', strtotime( $q->updated_at));

            if($q->label_step == 0){
                $step[$h] = 'Belum Terproses';
            }else{
                $step[$h] = 'Lakukan Klasifikasi';
            }
            $h++;
        }
        
        $i = 0;
        $data = [];

        foreach($d as $s){
            $data[$i] = [
                $s->id_user,
                $s->username,
                $s->j_data,
                $step[$i],
                $date[$i],
            ];
            $i++;
        }
        // dd($data);

        return response($data);
    }

    function ProsesPelabelanPancasilais(Request $request){
        $check_label_step = DB::table('pelabelan')
            ->where('id_user', '=', $request->id_user)
            ->count();

        if($check_label_step == 0){
            
            $kamus = DB::table('kamus_pancasilais')
                ->select([
                    'data'
                ])
                ->get();
            $tweet = DB::table('data_ready')
                ->where('id_user', '=', $request->id_user)
                ->select([
                    'id_data_ready',
                    'ready_data'
                ])
                ->get();

            $h = 0;
            $data = [];
            foreach($tweet as $d){
                $data[$h] = json_decode($d->ready_data, true);
                $jumlah_data = count($data[$h]);
                foreach($data[$h] as $row){
                        $c_pancasilais = DB::table('kamus_pancasilais')
                            ->where('data', 'like', '%' . $row . '%')
                            ->count();
                        
                        if($c_pancasilais > 0){
                            $check_label = DB::table('pelabelan')
                                ->where('id_data_ready', '=', $d->id_data_ready)
                                ->count();

                            if($check_label > 0){
                                $get_data = DB::table('pelabelan')
                                    ->where('id_data_ready', '=', $d->id_data_ready)
                                    ->get();
                            
                                $add_one = $get_data[0]->j_pancasilais + 1;

                                $update_data_pancasilais = DB::table('pelabelan')
                                    ->where('id_data_ready', '=', $d->id_data_ready)
                                    ->update([
                                        'j_pancasilais' =>  $add_one,
                                    ]);
                            }else{
                                // dd('data baru');
                                $tambah_data_pancasilais = DB::table('pelabelan')
                                    ->insert([
                                        'id_user' =>  $request->id_user,
                                        'id_data_ready' => $d->id_data_ready,
                                        'j_pancasilais' => 1,
                                        'created_at'    => Carbon::now(),
                                        'updated_at'    => Carbon::now(),
                                    ]);
                            }
                        }else{
                            $c_negative = DB::table('kamus_negative')
                            ->where('data', 'like', '%' . $row . '%')
                            ->count();

                            if($c_negative > 0 ){
                                $check_label_negative = DB::table('pelabelan')
                                    ->where('id_data_ready', '=', $d->id_data_ready)
                                    ->count();
                                if($check_label_negative > 0){
                                    $get_data_negative = DB::table('pelabelan')
                                    ->where('id_data_ready', '=', $d->id_data_ready)
                                    ->get();
                            
                                    $add_two = $get_data_negative[0]->j_negative + 1;

                                    $update_data_negative = DB::table('pelabelan')
                                        ->where('id_data_ready', '=', $d->id_data_ready)
                                        ->update([
                                            'j_negative' => $add_two,
                                        ]);
                                }else{
                                    $tambah_data_pancasilais = DB::table('pelabelan')
                                        ->where('id_data_ready', '=', $d->id_data_ready)
                                        ->insert([
                                            'id_user'       =>  $request->id_user,
                                            'id_data_ready' => $d->id_data_ready,
                                            'j_negative'    => 1,
                                            'created_at'    => Carbon::now(),
                                            'updated_at'    => Carbon::now(),
                                    ]);
                                }
                            }
                        }
                }

                $data_pelabelan = DB::table('pelabelan')
                    ->where('id_data_ready', '=', $d->id_data_ready)
                    ->select([
                        'j_pancasilais',
                        'j_negative',
                    ])
                    ->get();
                $h++; 
            }

            $update_label_step = DB::table('user')
                ->where('id_user', '=', $request->id_user)
                ->update([
                    'label_step' => 1
                ]);
            // dd('dd');
            return response()->json([
                'code' => 200,
                'message' => 'Data Berhasil Terproses'
            ]);
        }else{
            return response()->json([
                'code' => 500,
                'message' => 'Data Sudah terproses'
            ]);
        }
    }
    function ProcessKlasifikasiLabel(Request $request){
        $check_data = DB::table('pelabelan')
            ->where('id_user', '=', $request->id_user)
            ->count();
        if($check_data == 0 ){
            return response()->json([
                'code'      => 500,
                'message'   => 'Mohon Melakukan Pelabelan Terlebih dahulu !'
            ]);
        }else{
            $data = DB::table('pelabelan')
                ->where('id_user', '=', $request->id_user)
                ->select([
                    'id_data_ready',
                    'j_pancasilais',
                    'j_negative'
                ])
                ->get();
        
            foreach($data as $d){
                if($d->j_pancasilais > $d->j_negative){
                    $update_klasifikasi = DB::table('pelabelan')
                        ->where('id_data_ready', '=', $d->id_data_ready)
                        ->update([
                            'klasifikasi' => 'pancasilais'
                        ]);
                }elseif($d->j_pancasilais < $d->j_negative){
                     $update_klasifikasi = DB::table('pelabelan')
                        ->where('id_data_ready', '=', $d->id_data_ready)
                        ->update([
                            'klasifikasi' => 'negative'
                        ]);
                }else{
                    $update_klasifikasi = DB::table('pelabelan')
                        ->where('id_data_ready', '=', $d->id_data_ready)
                        ->update([
                            'klasifikasi' => 'netral'
                        ]);
                }
            }

            $count_data_pancasilais = DB::table('pelabelan')
                ->where('id_user', '=', $request->id_user)
                ->where('klasifikasi', '=', 'pancasilais')
                ->count();
                
            $count_data_negative = DB::table('pelabelan')
                ->where('id_user', '=', $request->id_user)
                ->where('klasifikasi', '=', 'negative')
                ->count();
                
            $count_data_netral = DB::table('pelabelan')
                ->where('id_user', '=', $request->id_user)
                ->where('klasifikasi', '=', 'netral')
                ->count();


            if($count_data_pancasilais > $count_data_negative && $count_data_pancasilais > $count_data_netral){
                $update_user = DB::table('user')
                    ->where('id_user', '=', $request->id_user)
                    ->update([
                        'class'         =>  'pancasilais',
                        'step'          =>  4,
                        'label_step'    =>  2,
                        'updated_at'    => Carbon::now()
                    ]);
            }elseif($count_data_negative > $count_data_pancasilais && $count_data_negative > $count_data_netral){
                $update_user = DB::table('user')
                    ->where('id_user', '=', $request->id_user)
                    ->update([
                        'class'         =>  'negative',
                        'step'          =>  4,
                        'label_step'    =>  2,
                        'updated_at'    => Carbon::now()
                    ]);
            }else{
                $update_user = DB::table('user')
                    ->where('id_user', '=', $request->id_user)
                    ->update([
                        'class'         =>  'netral',
                        'step'          =>  4,
                        'label_step'    =>  2,
                        'updated_at'    => Carbon::now()
                    ]);
            }
            return response()->json([
                    'code'       => 200,
                    'message'    => 'Akun Berhasil Teridentifikasi'
                ]);
        }
      
    }
}
