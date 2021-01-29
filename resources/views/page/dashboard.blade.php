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
    @yield('head-modal-content')
@endsection
@section('custom_script')
@endsection()