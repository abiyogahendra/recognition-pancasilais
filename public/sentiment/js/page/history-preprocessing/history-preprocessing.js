function DownloadFilePreprocessing(id){
    $.ajax({
        url : '/confirmation-download-file-preprocessing',
        data : {
            id_preprocessing : id,
            _token : dataToken
        },
        dataType : 'json',
        type : 'post',
        success : function(respon){
            if(respon.code == 500){
                swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Download Terjadi Masalah Terjadi Kesalahan',
                    html : "Harap Menghubungi Pengembang",
                    showConfirmButton: false,
                    timer: 2000
                })

            }else{
                window.location.href = "/download-file-preprocessing/"+ respon.file_name;
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Download Berhasil',
                    showConfirmButton: false,
                    timer: 1500
                }) 
            }
        }
    })
}

function ProcessPreprocessing(id){
    $.LoadingOverlay("show", {
        image       : "",
        fontawesome : "fa fa-cog fa-spin",
    });
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
                $.LoadingOverlay("hide")
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'input Berhasil',
                    html : 'Data Tweet ' + response.file_name + "  Telah berhasil diproses",
                    showConfirmButton: false,
                    timer: 2000
                }) 
                    $('.data-content').remove();
                    IndexHistoryPreprocessing();
            }else{
                $.LoadingOverlay("hide")
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


function IndexHistoryPreprocessing(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
      $.ajax({
          url : '/index-history-preprocessing',
          data : {},
          dataType : 'html',
          type : 'get',
          success : function(respon){
              $('.data_masuk').append(respon);
              $('.nav-active').removeClass("active");
              $('.nav-preprocessing').addClass("active");
  
              $('#table-history-preprocessing').DataTable({
                  ajax : {
                      url : '/data-history-preprocessing',
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
                          return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"> <a href="javascript:void(0)" style="color:black" onclick="DownloadFilePreprocessing('+data+')"><i class="fas fa-download"></i></a> | <a href="javascript:void(0)" style="color:black" onclick="ProcessPreprocessing('+data+')"><i class="fas fa-cogs"></i></a></div></div>';
                        }
                      },
                      
                  ],
              });
          }
      })
}