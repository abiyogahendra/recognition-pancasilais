function ProcessPreprocessing(id){
    $.ajax({
        url : 'process-preprocesing',
        data : {
            id_preprocessing : id,
            _token :dataToken,
        },
        type : 'post',
        dataType : 'json',
        success : function(response){
            if(response.code == 200){
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'input Berhasil',
                    html : 'Data Tweet ' + response.file_name + "  Telah berhasil diproses",
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
}

function IndexProcessPreprocessing(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
    $.ajax({
        url : '/index-process-preprocessing',
        data : {},
        dataType : 'html',
        type : 'get',
        success : function(respon){
            $('.data_masuk').append(respon);
            $('.nav-active').removeClass("active");
            $('.nav-preprocessing').addClass("active");

            $('#table-process-preprocessing').DataTable({
                ajax : {
                    url : '/data-process-preprocessing',
                    dataSrc : ''
                },
                "columnDefs": [ 
                    {"targets": 0,
                    "data": 0,
                    "render": function ( data, type, row, meta ) {
                        return '<div class="row center"><div class="col">'+data+'</div></div>';
                    }
                    },
                    {"targets": 1,
                    "data": 1,
                    "render": function ( data, type, row, meta ) {
                        return '<div class="row center"><div class="col">'+data+'</div></div>';
                    }
                    },
                    {"targets": 2,
                    "data": 2,
                    "render": function ( data, type, row, meta ) {
                        return '<div class="row center"><div class="col">'+data+'</div></div>';
                    }
                    },
                    {"targets": 3,
                    "data": 3,
                    "render": function ( data, type, row, meta ) {
                        return '<div class="row center"><div class="col">'+data+'</div></div>';
                    }
                    },
                    {"targets": 4,
                    "data": 0,
                    "render": function ( data, type, row, meta ) {
                        return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"> <a href="javascript:void(0)" style="color:black" onclick="ProcessPreprocessing('+data+')"><i class="fas fa-cogs"></i> Proses</a> </div></div>';
                    }
                    },
                ],
            });
        }
    })
}