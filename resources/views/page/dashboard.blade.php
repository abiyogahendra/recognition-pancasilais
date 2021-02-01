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
    <link rel="stylesheet" href="{{asset('sentiment/css/user-input/username-fileinput.css')}}">
@endsection


@section('custom_script')
<!-- page control -->
<script src="{{asset('/sentiment/js/page-control/page-control.js')}}"></script>


<!-- js input username -->
<script src="{{asset('/sentiment/js/user-input/username-fileinput.js')}}"></script>
@endsection()