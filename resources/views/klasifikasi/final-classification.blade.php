<div class="data-content">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card bg-white color-black" id="card-master">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">Input Username</h4>
                        <p class="card-category">Masukkan user id twitter yang akan dilakukan analisis</p>
                    </div>
                    <div class="card-body ">
                        <div class="container-username px-4 py-5 mx-auto">
                            <div class="card-username card0-username">
                                <div class="d-flex flex-lg-row flex-column-reverse">
                                    <div class="card-username card1-username">
                                        <div class="row justify-content-center my-auto">
                                            <div class="col-md-8 col-10 my-5">
                                                <div class="row justify-content-center px-3 mb-3"> <img id="logo-username" src="{{asset('storage/icon/1.png')}}"> </div>
                                                <h3 class="mb-5 text-center heading-username">Mari Bangun Pancasila</h3>
                                                <div class="form-group"> <label class="form-control-label text-muted">Username</label> <input type="text" name="final_username" placeholder="Masukkan ID Akun Twitter" class="form-control-username"> </div>
                                                <div class="row justify-content-center my-3 px-3"> <button onclick="PostDataFinalUsername()" class="button-username btn-block btn-color-username">Proses</button> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-username card2-username">
                                        <div class="my-auto mx-md-5 px-md-5 right-username">
                                            <h3 class="text-white center">Peringatan !!!</h3> <small class="text-white">Masukkan data akun yang sudah melakukan pelabelan dengan format "@namaakun"</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card bg-white color-black" id="card-master">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">History Final Classification</h4>
                        <p class="card-category">Berikut Ini Adalah History Proses Final Classification</p>
                    </div>
                    <div class="card-body ">
                        <div class="table">
                            <table class="table table-bordered fblack table-hover" id="table-final-classification">
                                <thead>
                                    <tr class="center">
                                        <th>ID Username</th>
                                        <th>Username</th>
                                        <th>Step</th>
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