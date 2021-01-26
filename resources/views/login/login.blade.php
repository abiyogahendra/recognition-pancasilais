<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pancasilais Recognition</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="css/mila-login.css">
</head>
<body>
<div class="container">
	<div class="row navi">
		<div class="col-md-2 col-md-offset-10">
		<div class="input-group">
			<span class="input-group-addon"><span class="glyphicon glyphicon-arrow-left"></span></span>
			<a href="./" class="btn btn-sm btn-primary btn-block btn-back" role="button">Kembali</a>
		</div>
		</div>
	</div>
    <div class="row main">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
					<h5 class="text-center bold">Sistem Pendukung Keputusan</h5>
					<h5 class="text-center">Penyeleksian Mahasiswa Penerima Beasiswa</h5>
					<h5 class="text-center">Menggunakan Algoritma Bayesian Classification</h5>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-body">
					<h4 class="text-center">Please Login!</h4>
                    <form id="FormLogin" class="form form-signup" role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <input id="email" type="text" autocomplete="off" class="form-control" placeholder="Email Address" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input id="password" type="password" autocomplete="off" class="form-control" placeholder="Password" />
                        </div>
                    </div>
					</form>
					<a href="#" class="btn btn-sm btn-primary btn-block btn-login" role="button">Login</a>
                </div>
            </div>
			
            <div class="panel panel-danger divresult">
                <div class="panel-heading"><h5 class="result"></h5></div>
			</div>
        </div>
    </div>
</div>
</div> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/mila-login.js"></script>
</body>
</html>