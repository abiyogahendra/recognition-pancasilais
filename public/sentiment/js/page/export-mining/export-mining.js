
function PageExportDataMining(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
    $.ajax({
        url : '/index-export-data-mining',
        data : {},
        dataType : 'html',
        type : 'get',
        success : function(respon){
            $('.data_masuk').append(respon);
            $('.nav-active').removeClass("active");
            $('.nav-mining').addClass("active");

            $('#table-history-mining').DataTable({
                ajax : {
                    url : '/data-export-mining',
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
                      "data": 4,
                      "render": function ( data, type, row, meta ) {
                        return '<div class="row center"><div class="col">'+data+'</div></div>';
                      }
                    },
                    
                    {"targets": 5,
                      "data": 0,
                      "render": function ( data, type, row, meta ) {
                        return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"> <a href="javascript:void(0)" style="color:black" onclick="ProsesToExportDataTwitter('+data+')"<span class="material-icons">download_for_offline</span></a> </div></div>';
                      }
                    },
                    
                ],
            });

        }
    })
}
function ProsesToExportDataTwitter(id){
    
    window.location.href = "/process-export-data-mining/"+ id;
    
    // $.ajax({
    //     url : '/process-export-data-mining',
    //     data : {
    //         id_user : id,
    //         _token : dataToken,
    //     },
    //     dataType : 'json',
    //     type : 'get',
    //     success : function(respon){
    //         if(respon.code == 200){
    //             swal.fire({
    //                 position: 'top-end',
    //                 icon: 'success',
    //                 title: 'Berhasil Melakukan Export',
    //                 html : 'Data Tweet ' + respon.tweet + "  Telah berhasil TerExport",
    //                 showConfirmButton: false,
    //                 timer: 2000
    //             }) 
    //         }else{
    //             swal.fire({
    //                 position: 'top-end',
    //                 icon: 'warning',
    //                 title: 'Export Terjadi Kesalahan',
    //                 html : "Harap Menghubungi Pengembang",
    //                 showConfirmButton: false,
    //                 timer: 2000
    //             })
    //         }
    //     }
    // })
}