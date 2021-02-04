function PagePreProcessing(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
    $.ajax({
        url : '/input-preprocessing',
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

// function PostInputPreprocessing(){
$(document).on('click','#form-preprocessing', function(){
    
    console.log(dataToken);
    // console.log($(this).parents('form')[0]);
        var formData = new FormData($(this).parents('form')[0]);
        console.log(formData);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" :dataToken
            }
        }),
        $.ajax({
            url : '/post-input-preprocessing',
            data    : formData,
            type : 'post',
            dataType : 'json',
            contentType : false,
            processData : false,
            success : function(response){
            if(response.code == 200){
                    swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'input Berhasil',
                        html : 'Data Tweet ' + respon.file_name + "  Telah berhasil Terinput",
                        showConfirmButton: false,
                        timer: 2000
                    }) 
            }else{
                    swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Export Terjadi Kesalahan',
                        html : "Harap Menghubungi Pengembang",
                        showConfirmButton: false,
                        timer: 2000
                    })
            }
            }
        })
    })
// }