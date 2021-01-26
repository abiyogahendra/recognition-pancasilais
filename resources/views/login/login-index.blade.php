<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pancasilais Recognition</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('sentiment/css/default/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('sentiment/css/default/bootstrap-theme.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('sentiment/css/login/login.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('sentiment/css/responsive/yobri-responsive.css')}}">
    
    <script src="https://kit.fontawesome.com/8d88473a47.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body>
<div class="container">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row center icon-garuda">
        <div class="col">
                <img src="{{asset('/storage/icon/garuda.png')}}" width="10%" class="icon-garuda" alt="">
        </div>
    </div>
    <div class="row main content-login " >
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
					<h5 class="text-center bold">Pancasilais Recognition</h5>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-body">
					<h4 class="text-center">Diharap Login</h4>
                    <form id="FormLogin" class="form form-signup" role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="fas fa-fingerprint"></i>
                            </span>
                            <input id="email" type="text" autocomplete="off" class="form-control" placeholder="Nomor Unix" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-unlock-alt"></i></span>
                            <input id="password" type="password" autocomplete="off" class="form-control" placeholder="Password" />
                        </div>
                    </div>
					</form>
					<a href="#" class="btn btn-sm btn-primary btn-block btn-login" role="button">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('sentiment/js/default/mila-login.js')}}"></script>
<script type="text/javascript" src="{{asset('sentiment/js/login/token.js')}}"></script>
<script type="text/javascript" src="{{asset('sentiment/js/default/post-login.js')}}"></script>
</body>
</html>