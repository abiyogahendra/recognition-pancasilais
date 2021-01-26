function IndexContentTransfer(ss){
    if ($(".data_content").length){
        $(".data_content").remove();
    }
    $.ajax({
        url: '/content_transfer',
        data : {
            id_transaction  : $('input[id=pay_idT]').val(),
            id_market       : $('input[id=pay_idM]').val(),
            kode_ss         : ss
        },
        type : 'POST',
        dataType : 'html',
        success: function(html){
            $('#modal_transaction_method').modal('hide');
            $(' #content_modal').append(html);
            $('.master_modal').modal('show');
            $( document ).ready(function() {
                // console.log( "ready!" );
                $('input[name="bank"]').click(function(){
                    if ($(this).is(':checked')){
                        $.loading.start('Loading...')
                        $.ajax({
                            url : '/cost_total',
                            data : {
                                bank            :   $('input[name=bank]:checked').val(),
                                id_market       :   $('input[name=id_market]').val(),
                                cost            :   $('input[name=first_cost]').val(),
                                kode_ss         :   $('input[name=kode_ss]').val(),
                            },
                            type : 'POST',
                            dataType : 'html',
                            success : function(html_2){
                                $.loading.end()
                                if ($(".cost_total").length){
                                   $(".cost_total").remove();
                                } 
                                $('.loadingio-spinner-spinner-zmm2x3qark').fadeIn();
                                $(' .before_cost').after(html_2);
                            }
                        })
                    }
                });
            });
        }
    })
}

function TransferTemporary(){
    if($('input[name=bank]:checked').val() == null){
        swal("Upsss", "Kamu harus memilih salah satu bank!", "error");
    }else{
        $.ajax({
            url : '/transfer_method',
            data : {
                kode_ss         :   $('input[name=kode_ss]').val(),
                id_market       :   $('input[name=id_market]').val(),
                id_transaction  :   $('input[name=id_pemesanan]').val(),
                quantity        :   $('input[name=quantity_fix]').val(),
                bank            :   $('input[name=bank]:checked').val(),
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
    }
    
}