

function Pengumpulan(){
    $.loading.start('Loading...')
    if ($(".data-content").length){
        $(".data-content").remove();
    }
    $.ajax({
        url : '/index_pengumpulan',
        data : {
        },
        type : 'get',
        dataType : 'html',
        success : function(pengumpulan){
            $('.data_masuk').append(pengumpulan);
            $('.nav-active').removeClass("active");
            $('.nav-pengumpulan').addClass("active");
            $.loading.end();
              $('#table-pengumpulan-dana').DataTable({
                  ajax : {
                      url : '/step_pengumpulan_dana',
                      dataSrc : ''
                    },
                    "columnDefs": [ 
  
                      {"targets": 3,
                        "data": 3,
                        "render": function ( data, type, row, meta ) {
                          return '<div class="row center"><div class="col">'+data+'</div></div>';
                        }
                      },
                      {"targets": 4,
                        "data": 4,
                        "render": function ( data, type, row, meta ) {
                          return '<div class="progress" style="border-radius:50px"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="200" aria-valuemin="0" aria-valuemax="100" style="width:'+data+'%">' +data+' %</div></div>';
                        }
                      },
                      {"targets": 5,
                        "data": 5,
                        "render": function ( data, type, row, meta ) {
                          return '<div class="row center"><div class="col">'+data+'</div></div>';
                        }
                      },
                      {"targets": 6,
                        "data": 0,
                        "render": function ( data, type, row, meta ) {
                          return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"> <a href="javascript:void(0)" style="color:black" onclick="DetailProgressRitzuka('+data+')"><i class="fa fa-eye"></i></a> </div></div>';
                        }
                      },
                      
                  ],
              });
        }
    })
}

