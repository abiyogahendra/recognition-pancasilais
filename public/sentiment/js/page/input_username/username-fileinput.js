function PageUsername(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
    $.ajax({
        url : '/input-username',
        data    : {

        },
        type : 'get',
        dataType : 'html',
        success : function(response){
            $('.nav-active').removeClass('active')
            $('.data_masuk').append(response);
            $('.nav-preprocessing').addClass('active')
        }
    })
}


function PostDataUsername(){
    $.LoadingOverlay("show", {
        image       : "",
        fontawesome : "fa fa-cog fa-spin",
    });
    $.ajax({
        url     : 'check-username',
        data    : {
            username : $("input[name=username]").val(),
            _token   : dataToken,
        },
        type : 'post',
        dataType : 'json',
        success : function(respon){
            if(respon.code == 200){
                $.LoadingOverlay("hide");
                var pageURL = $(location).attr("href");
                $.playSound(pageURL + 'sound/kawaii_.mp3')            
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Username Sudah didapatkan',
                    html : respon.tweet + " Data Tweet Terambil ",
                    showConfirmButton: false,
                    timer: 2000
                })
            }else if(respon.code == 300){
                $.LoadingOverlay("hide");
                Swal.fire({
                    title: 'User Sudah Ada',
                    text: "Apakah Ingin Tetap Menambahkan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tambahkan'
                  }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                $.ajax({
                                    url     : 'post-username',
                                    data    : {
                                        username : $("input[name=username]").val(),
                                        _token   : dataToken,
                                    },
                                    type : 'post',
                                    dataType : 'json',
                                    success : function(respon){
                                        if(respon.code == 200){
                                            swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                title: 'Username Sudah didapatkan',
                                                html : respon.tweet + " Data Tweet Terambil ",
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                        }else{
                                            swal.fire({
                                                position: 'top-end',
                                                icon: 'warning',
                                                title: 'Input Terjadi Kesalahan',
                                                html : respon.username + " Tidak Ditemukan ",
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                        }
                                    }
                                })
                            )
                        }
                    })
            }
        }
    })
}