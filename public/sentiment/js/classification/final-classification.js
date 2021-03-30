function PostDataFinalUsername(){
    $.LoadingOverlay("show", {
        image       : "",
        fontawesome : "fa fa-cog fa-spin",
    });
    var final_username = $('input[name=final_username]').val();
    $.ajax({
        url : '/post-data-final-username',
        data : {
            username : final_username,
            _token : dataToken,
        },
        dataType : 'json',
        type : 'post',
        success : function(respon){
            if(respon.code == 200 ){
                $.LoadingOverlay("hide");
                // $.playSound(pageURL + 'sound/kawaii_.mp3')
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Proses Berhasil',
                    html : respon.message,
                    showConfirmButton: false,
                    timer: 2000
                })
                $('.data-content').remove();
                FinalClassificationIndex();
            }else{
                $.LoadingOverlay("hide");
                swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Import Terjadi Kesalahan',
                    html : "Harap Menghubungi Pengembang",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function PostPreprocessingFinalClassification(id){
    $.LoadingOverlay("show", {
        image       : "",
        fontawesome : "fa fa-cog fa-spin",
    });
    $.ajax({
        url : '/post-preprocessing-final-username',
        data : {
            id_user : id,
            _token : dataToken,
        },
        dataType : 'json',
        type : 'post',
        success : function(respon){
            if(respon.code == 200 ){
                $.LoadingOverlay("hide");
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Proses Berhasil',
                    html : respon.message,
                    showConfirmButton: false,
                    timer: 2000
                })
                $('.data-content').remove();
                FinalClassificationIndex();
            }else{
                $.LoadingOverlay("hide");
                swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Import Terjadi Kesalahan',
                    html : "Harap Menghubungi Pengembang",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function ProsesFinalClassification(id){
    // $.LoadingOverlay("show", {
    //     image       : "",
    //     fontawesome : "fa fa-cog fa-spin",
    // });
    $.ajax({
        url : '/post-process-final-data',
        data : {
            id_user : id,
            _token : dataToken,
        },
        dataType : 'json',
        type : 'post',
        success : function(respon){
            if(respon.code == 200 ){
                $.LoadingOverlay("hide");
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Proses Berhasil',
                    html : respon.message,
                    showConfirmButton: false,
                    timer: 2000
                })
                $('.data-content').remove();
                FinalClassificationIndex();
            }else{
                $.LoadingOverlay("hide");
                swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Import Terjadi Kesalahan',
                    html : "Harap Menghubungi Pengembang",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function FinalClassificationIndex(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
      $.ajax({
          url : '/index-dashboard-final-klasifikasi',
          data : {},
          dataType : 'html',
          type : 'get',
          success : function(respon){
              $('.data_masuk').append(respon);
              $('.nav-active').removeClass("active");
              $('.nav-final-classification').addClass("active");
  
              $('#table-final-classification').DataTable({
                  ajax : {
                      url : '/data-table-final-classification',
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
                            return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"> <a href="javascript:void(0)" style="color:black" onclick="DetailProgressRitzuka('+data+')"><i class="fa fa-eye"></i></a> | <a href="javascript:void(0)" style="color:black" onclick="PostPreprocessingFinalClassification('+data+')"><i class="fas fa-server"></i></a> | <a href="javascript:void(0)" style="color:black" onclick="ProsesFinalClassification('+data+')"><i class="fas fa-object-group"></i></a> </div></div>';
                          }
                        },
                        
                    ],
              });
          }
      })
  }