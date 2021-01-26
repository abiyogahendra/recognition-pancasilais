function SaldoConfirmation(transac, mark, quan, ss){
    if ($(".data_content").length){
        $(".data_content").remove();
    }
    $.ajax({
        url  : '/saldo',
        data : {
            id_transaction  : transac,
            id_market       : mark,
            quantity        : quan,
            kode_ss         : ss
        },
        type : 'POST',
        dataType : 'json',
        success: function(q){
            if(q.kode == 200){
                var url_update = window.location.href;
                window.history.replaceState(null, null, url_update)
                $('#modal_confirmation').modal('hide');
                swal("Pembayaran Berhasil","Trimakasih Telah Berbagi", "success");
                $('#campaign').fadeOut();
                $('#campaign').load('/user_profile' + ' #campaign', function(){
                    $('#campaign').fadeIn();
                });
            } else {
                swal("Upsss, Ada Kesalahan", "Segera laporkan ke customer service", "warning");
            }
        }
    })
}
function SaldoModal(ss){ 
    if ($(".data_content").length){
        $(".data_content").remove();
    }
    form =  parseInt($('input[id=pay_idT]').val(),) + parseInt($('input[id=pay_idM]').val(),);
    $.ajax({
        url  : '/verify_saldo',
        data : {
            id_transaction  : $('input[id=pay_idT]').val(),
        },
        type : 'POST',
        dataType : 'json',
        success: function(q){
            if(q.status == 500 ){
                swal( q.message1, q.message2, "error");
            }else{                
                $.ajax({
                    url : '/content_saldo',
                    data : {
                        id_transaction  : $('input[id=pay_idT]').val(),
                    },
                    type : 'post',
                    dataType : 'html',
                    success : function(html){
                        $.loading.start('Loading...')
                        $('#modal_transaction_method').modal('hide');
                        $(' #content_modal').append(html);
                        $('.master_modal').modal('show');
                        $.loading.end()
                    }
                })
            }
        }
    })
}
$(".laporan_progress" ).click(function() {
    location.reload();
});

function SaldoTemporary(){
    swal({
        title: "Apakah Anda Yakin?",
        text: "Saldo Anda Akan Terpotong Secara Otomatis!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url : '/saldo_method',
                data : {
                    id_transaction  :   $('input[name=id_pemesanan]').val(),
                    quantity        :   $('input[name=quantity_fix]').val(),
                    cost            :   $('input[name=cost]').val(),
            },
            type : 'POST',
            dataType : 'json',
            success : function (json){
                if(json.status == 200 ){
                    swal("Pemilihan Berhasil", json.message , "success");
                    var url_update = window.location.href;
                    window.history.replaceState(null, null, url_update)

                    $('#campaign').fadeOut();
        
                      $('.reload').fadeOut();
                      
                      $('#campaign').load('/user_profile' + ' #campaign', function(){
                          $('#campaign').fadeIn();
                        });
                        $('#reload').load('/user_profile' + ' .reload', function(){
                            $('.reload').fadeIn();
                        });
                        
                        $(".modal").modal('hide');
                    }else{
                        swal("Maaf", "terjadi Error");
                    }
                }
            }) 
        } else {
            swal("Terimakasih Konfirmasinya!");
        }
    });
    }
        