function PostLogin(){
    $.ajax({
        url : '/login_post',
        data : {
            code_unix   : $("input[name = code_unix]").val(),
            password    : $("input[name = password]").val(),
            _token      : dataToken
        },
        type : 'post',
        dataType : 'json',
        success : function(resp){
            if(resp.code == 200 ){
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    html : 'Selamat Datang',
                    timerProgressBar: true,
                    timer: 3000
                  })
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Gagal',
                    html : 'Mohon Ulangi Kembali',
                    timerProgressBar: true,
                    timer: 3000
                  })
            }
        }
    })
}

$(document).on('keypress',function(e) {
    if(e.which == 13) {
        PostLogin();
    }
});