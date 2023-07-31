<div class="btn-group" role="group">
	<div class="mx-1">
			<button type="button" data-id="{{ $model->id }}" class="btn btn-primary btn-sm transaction-detail"
					data-bs-toggle="modal" data-bs-target="#showTransactionModal">
					<i class="bi bi-search"></i>
			</button>
	</div>

	<div class="mx-1">
			<button type="button" data-id="{{ $model->id }}" class="btn btn-success btn-sm transaction-edit"
					data-bs-toggle="modal" data-bs-target="#editTransactionModal">
					<i class="bi bi-pencil-square"></i>
			</button>
	</div>

	<div class="mx-1">
			<form action="{{ route('transactions.destroy', $model->id) }}" method="POST" class="d-inline-block">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger btn-sm delete-notification" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi keuangan ini?')">
							<i class="bi bi-trash-fill"></i>
					</button>
			</form>
	</div>
</div>
