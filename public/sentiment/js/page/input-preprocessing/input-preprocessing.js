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
        $.LoadingOverlay("show", {
            image       : "",
            fontawesome : "fa fa-cog fa-spin",
        });
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
                console.log(response.code)
            if(response.code == 200){
                $.LoadingOverlay("hide");
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'input Berhasil',
                    html : 'Data Tweet ' + response.file_name + "  Telah berhasil Terinput",
                    showConfirmButton: false,
                    timer: 2000
                }) 
            }else{
                $.LoadingOverlay("hide");
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