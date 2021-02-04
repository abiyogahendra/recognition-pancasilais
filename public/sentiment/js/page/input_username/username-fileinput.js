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
            $('.nav-mining').addClass('active')
        }
    })
}


function PostDataUsername(){
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
}