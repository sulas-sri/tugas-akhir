<div class="modal fade" id="addTransactionModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
					<div class="modal-header">
							<h5 class="modal-title">Tambah Transaksi Keuangan</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
							<form action="#" method="POST">
									@csrf

									<div class="form-group">
											<label for="type">Tipe Transaksi</label>
											<select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
													<option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Pemasukan</option>
													<option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
											</select>
											@error('type')
													<span class="invalid-feedback">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
											<label for="date">Tanggal Transaksi</label>
											<input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
											@error('date')
													<span class="invalid-feedback">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
											<label for="description">Deskripsi</label>
											<input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required>
											@error('description')
													<span class="invalid-feedback">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
											<label for="amount">Jumlah</label>
											<input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
											@error('amount')
													<span class="invalid-feedback">{{ $message }}</span>
											@enderror
									</div>

									<button type="submit" class="btn btn-primary">Tambah</button>
							</form>
					</div>
			</div>
	</div>
</div>
