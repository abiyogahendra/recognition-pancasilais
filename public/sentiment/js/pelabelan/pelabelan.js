function ProsesKlasifikasiLabel(id){
  $.LoadingOverlay("show", {
    image       : "",
    fontawesome : "fa fa-cog fa-spin",
  });
  $.ajax({
    url : '/proses-klasifikasi-label',
    data : {
        id_user : id,
        _token : dataToken
    },
    dataType : 'json',
    type : 'post',
    success : function(respon){
      if(respon.code == 200){
        $.LoadingOverlay("hide")
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: respon.message,
            showConfirmButton: false,
            timer: 1500
          })
          $('.data-content').remove();
          HistoryPelabelan();
      }else{
        $.LoadingOverlay("hide")
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
}

function ProsesPelabelan(id){
  $.LoadingOverlay("show", {
    image       : "",
    fontawesome : "fa fa-cog fa-spin",
  });
    $.ajax({
        url : '/proses-pelabelan',
        data : {
            id_user : id,
            _token : dataToken
        },
        dataType : 'json',
        type : 'post',
        success : function(respon){
          if(respon.code == 200){
            $.LoadingOverlay("hide")
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: respon.message,
                showConfirmButton: false,
                timer: 1500
              })
              $('.data-content').remove();
              HistoryPelabelan();
          }else{
            $.LoadingOverlay("hide")
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
}

function HistoryPelabelan(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
    
      $.ajax({
          url : '/index-history-pelabelan',
          data : {},
          dataType : 'html',
          type : 'get',
          success : function(respon){
              $('.data_masuk').append(respon);
              $('.nav-active').removeClass("active");
              $('.nav-pelabelan').addClass("active");
  
              $('#table-history-pelabelan').DataTable({
                  ajax : {
                      url : '/data-history-pelabelan',
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
                          return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"> <a href="javascript:void(0)" style="color:black" onclick="DetailProgressRitzuka('+data+')"><i class="fa fa-eye"></i></a> | <a href="javascript:void(0)" style="color:black" onclick="ProsesPelabelan('+data+')"><i class="fas fa-microchip"></i></a> | <a href="javascript:void(0)" style="color:black" onclick="ProsesKlasifikasiLabel('+data+')"><i class="fas fa-object-group"></i></a></div></div>';
                        }
                      },
                      
                  ],
              });
          }
      })
  }