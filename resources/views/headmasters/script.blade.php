<script>
	$(function () {
		let loadingAlert = $('.modal-body #loading-alert');

		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('headmasters.index') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'name', name: 'name' },
				{ data: 'email', name: 'email' },
				{ data: 'created_at', name: 'created_at' },
				{ data: 'action', name: 'action' },
			]
		});

		$('#datatable').on('click', '.headmaster-detail', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.headmaster.show', ':param') }}";
			url = url.replace(':param', id);

			$('#showHeadmasterModal input').val('Sedang mengambil data..');

			$.ajax({
				url: url,
				headers: {
					'Authorization': 'Bearer ' + localStorage.getItem('token'),
					'Accept': 'application/json',
					'Content-Type': 'application/json'
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#showHeadmasterModal #name').val(response.data.name);
					$('#showHeadmasterModal #email').val(response.data.email);
				}
			});
		});

		$('#datatable').on('click', '.headmaster-edit', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.headmaster.edit', ':param') }}";
			url = url.replace(':param', id);

			let formActionURL = "{{ route('headmasters.update', ':param') }}";
			formActionURL = formActionURL.replace(':param', id);

			let editHeadmasterModalEveryInput = $('#editHeadmasterModal :input').not('button[type=button], input[name=_token], input[name=_method]')
				.each(function () {
					$(this).not('input[id=password], input[id=password_confirmation]').val('Sedang mengambil data..');
					$(this).prop('disabled', true);
				});

			$.ajax({
				url: url,
				headers: {
					'Authorization': 'Bearer ' + localStorage.getItem('token'),
					'Accept': 'application/json',
					'Content-Type': 'application/json'
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#editHeadmasterModal #headmaster-edit-form').attr('action', formActionURL);

					editHeadmasterModalEveryInput.prop('disabled', false);

					$('#editHeadmasterModal #name').val(response.data.name);
					$('#editHeadmasterModal #email').val(response.data.email);
				}
			});
		});
	});
</script>
