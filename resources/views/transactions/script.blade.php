<!-- resources/views/transactions/scripts.blade.php -->

<script>
	$(function () {
			let loadingAlert = $('.modal-body #loading-alert');

			$('#datatable').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{{ route('transactions.index') }}",
					columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'type', name: 'type' },
							{ data: 'amount', name: 'amount' },
							{ data: 'description', name: 'description' },
							{ data: 'date', name: 'date' },
							{ data: 'action', name: 'action' },
					]
					debug: true,
			});

			$('#datatable').on('click', '.transaction-detail', function () {
					// Your logic for showing details in the modal goes here
			});

			$('#datatable').on('click', '.transaction-edit', function () {
					// Your logic for editing transactions goes here
			});
	});
</script>
