<div class="modal fade" id="editBillingModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
					<div class="modal-header">
							<h5 class="modal-title">Edit Data Tagihan</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						@include('utilities.loading-alert')
						<form action="#" method="POST" id="billing-edit-form">
									@csrf
									@method('PUT')
									<div class="row">
											<div class="col-md-12">
												<label for="student_id" class="form-label">Nama Siswa</label>
												<input type="hidden" name="student_id" id="student_id">
												<input type="text" class="form-control" name="student_name" id="student_name" readonly>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<label for="bill" class="form-label">Jumlah Tagihan</label>
												<input type="number" class="form-control" name="bill" value="{{ config('app.bill') }}" id="bill"
													readonly>
											</div>
										</div>

										{{-- <div class="col-md-6">
											<div class="mb-3">
												<label for="amount" class="form-label">Total Bayar</label>
												<input type="number" class="form-control" name="amount" id="amount"
													placeholder="Masukkan total bayar..">
											</div>
										</div>
									</div> --}}

									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label for="due_date" class="form-label">Jatuh Tempo</label>
												<input type="date" class="form-control" name="date" id="date" placeholder="Pilih tanggal..">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="mb-3">
											<label for="note" class="form-label">Catatan</label>
											<textarea class="form-control" name="note" id="note" rows="3"
												placeholder="Masukkan catatan (opsional).."></textarea>
										</div>
									</div>
									<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
							</form>
					</div>
			</div>
	</div>
</div>
