var pancasilais = parseInt($('input[name=data_pancasilais]').val()) 
var netral = parseInt($('input[name=data_netral]').val())
var negative = parseInt($('input[name=data_negative]').val())
var train_pancasilais = parseInt($('input[name=data_train_pancasilais]').val()) 
var train_netral = parseInt($('input[name=data_train_netral]').val())
var train_negative = parseInt($('input[name=data_train_negative]').val())



Highcharts.chart('report-train', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Riwayat Training'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Pancasilais',
      y: train_pancasilais,
      sliced: true,
      selected: true
    }, {
      name: 'Netral',
      y: train_netral
    }, {
      name: 'Negative',
      y: train_negative
    }]
  }]
});



Highcharts.chart('report-persentase', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Riwayat Klasifikasi 25% Data'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Pancasilais',
      y: pancasilais,
      sliced: true,
      selected: true
    }, {
      name: 'Netral',
      y: netral
    }, {
      name: 'Negative',
      y: negative
    }]
  }]
});


function DeleteAllDataUser(id){
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
            $.LoadingOverlay("show", {
                image       : "",
                fontawesome : "fa fa-cog fa-spin",
            });
            $.ajax({
                url : '/delete-all-data-history-user',
                data : {
                    _token : dataToken,
                    id_user : id
                },
                dataType : 'json',
                type : 'post',
                success : function(respon){
                    if(respon.code == 200){
                        $.LoadingOverlay("hide");
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: respon.message,
                        })

                        // $('.data-content').fadeOut();
        
                        // $('.data-content').load('/' + ' .history-user', function(){
                        //     $('.data-content').fadeIn();
                        // });
                        
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
    })
}


$( document ).ready(function() {
    var data = $('#table-history-user').DataTable({
        ajax : {
            url : '/data-history-user',
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
              "data": 5,
              "render": function ( data, type, row, meta ) {
                return '<div class="row center"><div class="col">'+data+'</div></div>';
              }
            },
            
            {"targets": 6,
              "data": 0,
              "render": function ( data, type, row, meta ) {
                return ' <div class="row justify-content-center"> <div class="col" style="text-align:center"><a href="javascript:void(0)" style="color:black" onclick="DeleteAllDataUser('+data+')"><i class="fas fa-trash-alt"></i> </div></div>';
              }
            },
            
        ],
        
    });

    // setInterval( function () {
    //     data.ajax.reload( null, false ); // user paging is not reset on reload
    // }, 2000 );
  
});