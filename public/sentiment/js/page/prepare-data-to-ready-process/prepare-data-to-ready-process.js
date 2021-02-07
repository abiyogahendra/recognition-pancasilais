function ProcessDataToReadyData(id){
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
                swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'input Berhasil',
                    html : respon.data + " Data Siap Diproses",
                    showConfirmButton: false,
                    timer: 2000
                });
            }
            else if (respon.code == 500){
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




function IndexPrepareData(){
    if ($(".data-content").length){
        $(".data-content").remove();
    }
    $.ajax({
        url : '/index-data-to-ready-process',
        data : {},
        type : 'get',
        dataType : 'html',
        success : function(respon){
            $('.data_masuk').append(respon);
            $('.nav-active').removeClass("active");
            $('.nav-preprocessing').addClass("active");

            $('#table-prepare-data-to-ready-data').DataTable({
                ajax : {
                    url : '/data-to-ready-process',
                    dataSrc : ''
                  },
                  "columnDefs": [ 
                    {"targets": 0,
                      "data": 0,
                      "render": function (data) {
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
                        return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"> <a href="javascript:void(0)" style="color:black" onclick="ProcessDataToReadyData('+data+')"><i class="fas fa-cogs"></i> Process</a> </div></div>';
                      }
                    },
                    
                ],
            });







        }
    })
}