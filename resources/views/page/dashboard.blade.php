@extends ('master.master')

@section ('content')
    <div class="row data-content">
        <div class="col">
            <div class="row">
                <div class="col">
                    <figure class="highcharts-figure">
                        <div class="report-train" id="report-train"></div>
                    </figure>
                </div>
                <div class="col">
                    <figure class="highcharts-figure">
                        <div class="report-persentase" id="report-persentase"></div>
                    </figure>
                </div>
            </div>
            <div class="hidden-data">
                <input type="hidden" class="hidden" name="data_train_pancasilais" value="{{$persentasi_pancasilais_training}}">        
                <input type="hidden" class="hidden" name="data_train_netral" value="{{$persentasi_netral_training}}">        
                <input type="hidden" class="hidden" name="data_train_negative" value="{{$persentasi_negative_training}}">        
                <input type="hidden" class="hidden" name="data_pancasilais" value="{{$persentase_pancasilais}}">        
                <input type="hidden" class="hidden" name="data_netral" value="{{$persentase_netral}}">        
                <input type="hidden" class="hidden" name="data_negative" value="{{$persentase_negative}}">        
            </div>
            <div class="row" style="display:none">
                <div class="col">
                    <div >
                       
                    </div>
                </div>
            </div>
            <div class="row center justify-content-center">
                <div class="col">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">content_copy</i>
                            </div>
                            <p class="card-category">Nilai Akurasi</p>
                            <h3 class="card-title">
                                <small>Bernilai</small>
                                    {{$akurasi}}
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-warning">warning</i>
                                <a href="void:javascript(0)" class="warning">Danai Ritzuka lain?</a>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">Nilai Presisi</p>
                            <h3 class="card-title">
                                <small>Bernilai</small>
                                    {{$presisi}}
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">data_range</i>
                                <a href="void:javascript(0)">Danai Ritzuka lain?</a>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">content_copy</i>
                            </div>
                            <p class="card-category">Nilai Recall</p>
                            <h3 class="card-title">
                                <small>Bernilai</small>
                                    {{$recall}}
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-warning">warning</i>
                                <a href="void:javascript(0)" class="warning">Danai Ritzuka lain?</a>   
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="row history-user">
                <div class="col">
                    <div class="card">
                        <div class="card bg-white color-black" id="card-master">
                            <div class="card-header card-header-info">
                                <h4 class="card-title">Data User</h4>
                                <p class="card-category">Berikut adalah data History User</p>
                            </div>
                            <div class="card-body ">
                                <div class="table">
                                    <table class="table table-bordered fblack table-hover" id="table-history-user">
                                            <thead>
                                                <tr class="center">
                                                    <th>ID Username</th>
                                                    <th>Username</th>
                                                    <th>Jumlah Tweet</th>
                                                    <th>Keterangan</th>
                                                    <th>Class</th>
                                                    <th>Update Time</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    





    @include('master.modal')
    
@endsection()

@section('custom_head')

<!-- username head -->
    <link rel="stylesheet" href="{{asset('sentiment/css/page/input-username/username-fileinput.css')}}">


<!-- preprocessing head -->
    <link rel="stylesheet" href="{{asset('sentiment/css/page/input-preprocessing/preprocessing-fileinput.css')}}">
    
    <!-- input Kamus -->
    <link rel="stylesheet" href="{{asset('sentiment/css/button/input-kamus.css')}}">



@endsection


@section('custom_script')
<script src="{{asset('/sound/jquery.playSound.js')}}"></script>

<!-- token -->
<script src="{{asset('/sentiment/js/token/token.js')}}"></script>


<!-- page control -->
<script src="{{asset('/sentiment/js/page-control/page-control.js')}}"></script>

<!-- js preprocessing Input -->
<script src="{{asset('/sentiment/js/page/input_username/username-fileinput.js')}}"></script>
<script src="{{asset('/sentiment/js/page/history-mining/history-mining.js')}}"></script>
<script src="{{asset('/sentiment/js/page/history-preprocessing/history-preprocessing.js')}}"></script>
<script src="{{asset('/sentiment/js/page/history-import-database/history-import-database.js')}}"></script>

<!-- js kamus -->
<script src="{{asset('/sentiment/js/kamus/input-kamus.js')}}"></script>

<!-- js Pelabelan -->
<script src="{{asset('/sentiment/js/pelabelan/pelabelan.js')}}"></script>


<!-- js final classification -->
<script src="{{asset('/sentiment/js/classification/final-classification.js')}}"></script>


<!-- dashboard -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="{{asset('sentiment/js/dashboard/chart/dashboard-chart.js')}}"></script>




@endsection()