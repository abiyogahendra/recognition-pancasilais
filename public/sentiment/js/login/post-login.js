function PostLogin(){
    $.ajax({
        url : '/login_post',
        data : {
            code_unix   : $("input[name = code_unix]").val(),
            password    : $("input[name = password]").val(),
            _token      : data_token
        },
        type : 'post',
        dataType : 'json',
        success : function(resp){
            if(resp.code == 200 ){
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    hmtl : 'Selamat Datang ',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }else{
                swal
            }
        }
    })
}