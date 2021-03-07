function CleanDataTweet(id){
    $.LoadingOverlay("show", {
        image       : "",
        fontawesome : "fa fa-cog fa-spin",
    });
    $.ajax({
        url : '/check-data-ready',
        data : {
            id_username : id,
            _token : dataToken,
        },
        type : 'post',
        dataType : 'json',
        success : function(response){
            if(response.code == 200){
                $.ajax({
                    url : '/process-data-to-ready-data',
                    data : {
                        id_username : id,
                        _token : dataToken,
                    },
                    type : 'post',
                    dataType : 'json',
                    success : function(respon){
                        if(respon.code == 200){
                            $.LoadingOverlay("hide");
                            var pageURL = $(location).attr("href");
                            // $.playSound(pageURL + 'sound/kawaii_.mp3'); 
                            swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'input Berhasil',
                                html : respon.data + " Data Siap Diproses",
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $('.data-content').remove();
                            HistoryImprotDatabase();
                        }
                        else if (respon.code == 500){
                            $.LoadingOverlay("hide");
                            swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                title: 'Terjadi Kesalahan Saat Pembersihan',
                                html : "Harap Menghubungi Pengembang",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    }
                })
            }else{
                $.LoadingOverlay("hide");
                swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Belum Boleh',
                    html : "Perlu Import Terlebih Dahulu",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function ImportIntoDatabase(id){
  $.LoadingOverlay("show", {
        image       : "",
        fontawesome : "fa fa-cog fa-spin",
    });
    $.ajax({
      url : '/check-data-import',
      data : {
          _token : dataToken,
          id_user : id
      },
      dataType : 'json',
      type : 'post',
      success : function(response){
          console.log(response);
        if(response.code == 200){
            $.ajax({
                url : '/data-import-to-database',
                data : {
                    _token : dataToken,
                    id_user : id
                },
                dataType : 'json',
                type : 'post',
                success : function(respon){
                    if(respon.code == 200){
                        $.LoadingOverlay("hide");
                        var pageURL = $(location).attr("href");
                        // $.playSound(pageURL + 'sound/kawaii_.mp3') 
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Import Data Berhasil',
                            html : respon.message,
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('.data-content').remove();
                        HistoryImprotDatabase();
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
        }else{
            $.LoadingOverlay("hide");
                swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Data Sudah Terimport',
                    html : "Jangan Mengulangi Yang Tidak Perlu",
                    showConfirmButton: false,
                    timer: 2000
                })
        }
      }
    })  
}

function HistoryImprotDatabase(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
      $.ajax({
          url : '/index-history-import-database',
          data : {},
          dataType : 'html',
          type : 'get',
          success : function(respon){
              $('.data_masuk').append(respon);
              $('.nav-active').removeClass("active");
              $('.nav-preprocessing').addClass("active");
  
              $('#table-history-import-database').DataTable({
                  ajax : {
                      url : '/data-history-import-database',
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
                          return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"> <a href="javascript:void(0)" style="color:black" onclick="DetailProgressRitzuka('+data+')"><i class="fa fa-eye"></i></a> | <a href="javascript:void(0)" style="color:black" onclick="ImportIntoDatabase('+data+')"><i class="fas fa-server"></i></a> | <a href="javascript:void(0)" style="color:black" onclick="CleanDataTweet('+data+')"><i class="fas fa-hand-sparkles"></i></a> </div></div>';
                        }
                      },
                      
                  ],
              });
          }
      })
  }