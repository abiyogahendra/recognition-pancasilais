  var total_booking = 0;
  
  function OpenTransaction(id, price, available){
    $('#id_available').val(available);
    // console.log(id);
    $('#id_market').val(id);
    // console.log(price);
    $('#id_price').val(price);
    // console.log(available)
  }

  function OpenbookingFunct(value){
    price = $('#id_price').val();
    slot_booking = $('.quantity').val();
    total_booking = parseFloat(price) * parseFloat(value);
    // console.log(total_booking);
    final = total_booking.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('.count_total').text(final);
  }

  $('.user_create_booking_tmp').on('click', function () {
    $.ajax({
      url: '/profil_user',
      data: {
        quantity        : $('input[name=quantity]').val(),
        id_market       : $('input[name=id_market]').val(), 
        available_slot  : $('input[name=id_available]').val(),
        price_slot      : $('input[name=id_price]').val(),          
      },
      type: 'POST',
      dataType: 'json',
      success: function (d) {
           if(d.status == 500){
            swal("Maaf", "Tolong Isikan quantity");
           }else{
            $('#modal_booking').modal('hide');
            swal("Pemesanan Berhasil", "Klik Untuk Masuk Beranda User", "success");
              document.location.href = '/user_profile';
           }
      }
  });
})



// edit function
  function EditTransaction(id, price){
    id_transaction = id;
    price_unit = price;
    // console.log(price);
    $('#id_transaction').val(id_transaction);
    $('#id_price').val(price_unit);
  }

  function bookingFunct(value){
    price = $('#id_price').val();
    slot_booking = $('.quantity').val();
    total_booking = parseFloat(price) * parseFloat(value);
    console.log(total_booking);
    final = total_booking.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('.count_total').text(final);
  }



$('.user_edit_booking_tmp').on('click', function (e) {
      $.ajax({
        url: '/profil_user/edit_transaction',
        data: {
          id_transaction  : $('input[name=id_transaction]').val(),
          quantity        : $('input[name=quantity]').val(),
        },
        type: 'POST',
        dataType: 'json',
        success: function (d) {
             if(d.status == 500){
                swal("Maaf", "Tolong Isikan quantity");
             }else{
              var url_update = window.location.href;
              window.history.replaceState(null, null, url_update)
                $('#modal_edit_booking').modal('hide');
                swal("Update Berhasil", d.message, "success");
                $('#campaign').fadeOut();
                $('#data_transaction').load('/user_profile' + ' #campaign', function(){
                  $('#campaign').fadeIn();
                });
             }
        }
    });
})

function DeletedTransaction(id){
  swal({
    title: "Apakah Anda Yakin ?",
    text: "Data Pesanan Anda Akan Dihapus!S",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    buttons: ["Tidak","Hapus"],
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
      url: '/profil_user/deleted_transaction',
      data: {
        id_transaction  : id,
      },
      type: 'POST',
      dataType: 'json',
      success: function (d) {
          if(d.status == 500){
              swal("Maaf", "terjadi Error");
          }else{
            var url_update = window.location.href;
            window.history.replaceState(null, null, url_update)
              swal("Hapus Berhasil", d.message, "success");
              $('#campaign').fadeOut();

              $('.reload').fadeOut();

              $('#campaign').load('/user_profile' + ' #campaign', function(){
                  $('#campaign').fadeIn();
              });
              $('#reload').load('/user_profile' + ' .reload', function(){
                  $('.reload').fadeIn();
              });
          }
      }
      });
    } else {
      swal("Trimakasih Konfirmasinya");
    }
  });
}
