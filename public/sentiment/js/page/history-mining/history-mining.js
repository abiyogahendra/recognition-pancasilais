
function Deleted_UserTweet(id){
    Swal.fire({
        title: 'Peringatan',
        text: "Apakah Tetap Ingin Menghapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
    }).then((confirm) => {
         if (confirm.isConfirmed) {
            $.ajax({
                url : '/delete-user-mining',
                data : {
                    _token : dataToken,
                    id_user : id
                },
                dataType : 'json',
                type : 'post',
                success : function(respon){
                    if(respon.code == 200){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: respon.message,
                        })
                       $('.data-content').remove();
                       HistoryMining();
                    }
                }
            })   
         }
    })
}

function ProsesToExportDataTwitter(id){
    // console.log(id);
    window.location.href = "/process-export-data-mining/"+ id;
    
}



function HistoryMining(){
  if ($(".data-content").length){
      $(".data-content").remove();
  }
  
    $.ajax({
        url : '/index-history-mining',
        data : {},
        dataType : 'html',
        type : 'get',
        success : function(respon){
            $('.data_masuk').append(respon);
            $('.nav-active').removeClass("active");
            $('.nav-mining').addClass("active");

            $('#table-history-mining').DataTable({
                ajax : {
                    url : '/data-history-mining',
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
                        return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"> <a href="javascript:void(0)" style="color:black" onclick="DetailProgressRitzuka('+data+')"><i class="fa fa-eye"></i></a> | <a href="javascript:void(0)" style="color:black" onclick="Deleted_UserTweet('+data+')"><i class="fas fa-trash-alt"></i> | <a href="javascript:void(0)" style="color:black" onclick="ProsesToExportDataTwitter('+data+')"><span class="material-icons">download_for_offline</span></a></div></div>';
                      }
                    },
                    
                ],
            });
        }
    })
}