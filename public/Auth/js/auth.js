 $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



$(document).ready(function() {
  $('.loadingio-spinner-spinner-zmm2x3qark').fadeOut();
});

$(function() {
  $('.user_login').on('click', function (e) {
      e.preventDefault();
      $('.loadingio-spinner-spinner-zmm2x3qark').fadeIn();
      $.ajax({
      url: '/user_login_7777',
      data: {
        number : $('input[name=user_number]').val(),
        password : $('input[name=user_password]').val()
      },
      type: 'POST',
      dataType: 'json',
      success: function (d) {
          
          if(d.status == 200){
            $('.loadingio-spinner-spinner-zmm2x3qark').fadeOut();
            document.getElementById("loading").style.visibility="hidden";
            $('.bd-example-modal-lg').modal('hide');
            swal("Login Berhasil", "Klik untuk masuk ke beranda pengguna", "success");
            var url = '/user_profile';
            document.location.href = url;
          }else{
            $('.loadingio-spinner-spinner-zmm2x3qark').fadeOut();
            alert(d)
          }
      }
    });
  })
})