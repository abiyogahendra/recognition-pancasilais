@extends ('master.master')

@section ('content')
    <div class="row data-content center">
       <div class="col">
            <h1>Selamat Datang</h1>
       </div>
    </div>
    @include('master.modal')
@endsection()

@section('custom_head')

<!-- username head -->
    <link rel="stylesheet" href="{{asset('sentiment/css/page/input-username/username-fileinput.css')}}">


<!-- preprocessing head -->
    <link rel="stylesheet" href="{{asset('sentiment/css/page/input-preprocessing/preprocessing-fileinput.css')}}">
    



@endsection


@section('custom_script')
<!-- token -->
<script src="{{asset('/sentiment/js/token/token.js')}}"></script>


<!-- page control -->
<script src="{{asset('/sentiment/js/page-control/page-control.js')}}"></script>

<!-- js Username Input -->
<script src="{{asset('/sentiment/js/page/input_username/username-fileinput.js')}}"></script>
<script src="{{asset('/sentiment/js/page/history-mining/history-mining.js')}}"></script>
<script src="{{asset('/sentiment/js/page/export-mining/export-mining.js')}}"></script>

<!-- js input preprocessing -->
<script src="{{asset('/sentiment/js/page/history-preprocessing/history-preprocessing.js')}}"></script>
<script src="{{asset('/sentiment/js/page/input-preprocessing/fileinput.js')}}"></script>
<script src="{{asset('/sentiment/js/page/input-preprocessing/input-preprocessing.js')}}"></script>
<script src="{{asset('/sentiment/js/page/process-preprocessing/process-preprocessing.js')}}"></script>
@endsection()