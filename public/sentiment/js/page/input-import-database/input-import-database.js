function IndexInputImportToDatabase(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
    $.ajax({
        url : '/input-import-to-database',
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
$(document).on('click','#form-import-db', function(){
    
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
            url : '/data-import-to-database',
            data    : formData,
            type : 'post',
            dataType : 'json',
            contentType : false,
            processData : false,
            success : function(response){
                console.log(response.code)
            if(response.code == 200){
                    swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'input Berhasil',
                        html : 'Data Tweet ' + response.file_name + "  Telah berhasil Terinput",
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