@extends ('master.master')

@section ('content')
<div class="row data-content">
        <div class="col">
            <div class="row">
                <div class="col">
                    <figure class="highcharts-figure">
                        <div class="report-persentase" id="report-persentase"></div>
                    </figure>
                </div>
            </div>
            <div class="hidden-data">
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

<!-- dashboard -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="{{asset('sentiment/js/dashboard/chart/dashboard-chart.js')}}"></script>




@endsection()