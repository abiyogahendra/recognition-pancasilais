<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('sentiment/css/CleanText.css')}}" rel="stylesheet">


</head>
<body>
    <div class="row">
        <div class="col">
            <div class="container justify-content-center">
                <div class="row">
                    <div class="col">
                        <div class="container center">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="white">Custom File Upload</h1>
                                    <p class="white">In this example, submit is allowed only in case the user uploads a valid image file.</p>
                                </div>
                            </div>
                            
                            <form name="upload" method="post" action="#" enctype="multipart/form-data" accept-charset="utf-8">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3 center">
                                        <div class="btn-container">
                                            <!--the three icons: default, ok file (img), error file (not an img)-->
                                            <h1 class="imgupload"><i class="fa fa-file-image-o"></i></h1>
                                            <h1 class="imgupload ok"><i class="fa fa-check"></i></h1>
                                            <h1 class="imgupload stop"><i class="fa fa-times"></i></h1>
                                            <!--this field changes dinamically displaying the filename we are trying to upload-->
                                            <p id="namefile">Only pics allowed! (jpg,jpeg,bmp,png)</p>
                                            <!--our custom btn which which stays under the actual one-->
                                            <button type="button" id="btnup" class="btn btn-primary btn-lg">Browse for your pic!</button>
                                            <!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
                                            <input type="file" value="" name="fileup" id="fileup">
                                        </div>
                                    </div>
                                </div>
                                    <!--additional fields-->
                                <div class="row">			
                                    <div class="col-md-12">
                                        <!--the defauld disabled btn and the actual one shown only if the three fields are valid-->
                                        <input type="submit" value="Submit!" class="btn btn-primary" id="submitbtn">
                                        <button type="button" class="btn btn-default" disabled="disabled" id="fakebtn">Submit! <i class="fa fa-minus-circle"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="{{asset('sentiment/js/CleanText.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>
</html>