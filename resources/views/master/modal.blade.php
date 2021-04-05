<div class="modal fade bd-example-modal-lg master_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content 2vw" id="content_modal">

				</div>
			</div>
	</div>


@section('js-viewTransaction')
    <script>
		function IndexModal(ss){
		if ($(".data_content").length){
			$(".data_content").remove();
		}
		$.ajax({
			url: '/persentase-account',
			data : {
				kode_ss         : ss,
				_token 			: dataToken
			},
			type : 'POST',
			dataType : 'html',
			success: function(html){
				$('#modal_transaction_method').modal('hide');
				$(' #content_modal').append(html);
				$('.master_modal').modal('show');
			}
		})
	}

	
	
	</script>
@endsection
