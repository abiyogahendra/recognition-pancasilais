function PostDataKamus(){
    $.ajax({
        url : '/process-input-kamus',
        data : {
            data_kamus : $('textarea[name=input_kamus').val(),
            _token : dataToken
        },
        dataType : 'json',
        type : 'post',
        success : function(respon){

        }
    })
}

function DataPositif(){
    Swal.fire({
        title: 'Masukkan Kamus',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Look up',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
          $.ajax({
              url : '/process-input-kamus-pancasilais',
              data : {
                    data_kamus : login,
                    _token : dataToken
                },
                dataType : 'json',
                type : 'post',
                success : function(respon){
                    if(respon.code == 200){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: respon.message,
                            showConfirmButton: false,
                            timer: 1500
                          })
                    }else{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            title: respon.message,
                            showConfirmButton: false,
                            timer: 1500
                          })
                    }
                }
          })
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
}
function DataNegative(){
    Swal.fire({
        title: 'Masukkan Kamus',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Look up',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            $.ajax({
                url : '/process-input-kamus-negative',
                data : {
                      data_kamus : login,
                      _token : dataToken
                  },
                  dataType : 'json',
                  type : 'post',
                  success : function(respon){
                      if(respon.code == 200){
                          Swal.fire({
                              position: 'top-end',
                              icon: 'success',
                              title: respon.message,
                              showConfirmButton: false,
                              timer: 1500
                            })
                      }else{
                          Swal.fire({
                              position: 'top-end',
                              icon: 'warning',
                              title: respon.message,
                              showConfirmButton: false,
                              timer: 1500
                            })
                      }
                  }
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
}

function PageInputKamus(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
    $.ajax({
        url : '/input-data-kamus',
        data : {},
        dataType : 'html',
        type : 'get',
        success : function(respon){
            $('.data_masuk').append(respon);
            $('.nav-active').removeClass("active");
            $('.nav-kamus').addClass("active");
        }
    })
}