@extends('siswa.layout.main', ['title' => 'Tagihan', 'page_heading' => 'Riwayat Tagihan'])

@section('content')
<section class="row">
	@include('utilities.alert-flash-message')
	<div class="col card px-3 py-3">
		<div class="d-flex justify-content-end pb-3">
			<div class="btn-group d-gap gap-2">
				{{-- <a href="{{ route('cash-transactions.export') }}" class="btn btn-success">
					<i class="bi bi-file-earmark-excel-fill"></i>
					Export Excel
				</a> --}}
				{{-- <a href="{{ route('cash-transactions.index.history') }}" class="btn btn-secondary">
					<span class="badge">{{ $cashTransactionTrashedCount }}</span> Histori Data Kas
				</a>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal"
					data-bs-target="#addCashTransactionModal">
					<i class="bi bi-plus-circle"></i> Tambah Data
				</button> --}}
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-sm w-100" id="datatable">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Pelajar</th>
						<th scope="col">ID Telegram</th>
						<th scope="col">Jumlah Tagihan</th>
						<th scope="col">Kategori Tagihan</th>
						<th scope="col">Jatuh Tempo</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					{{-- @foreach ($transactions as $transaction)
						<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $transaction->nama_pelajar }}</td>
								<td>{{ $transaction->kelas }}</td>
								<td>{{ $transaction->kategori_pembayaran }}</td>
								<td>{{ $transaction->total_bayar }}</td>
								<td>{{ $transaction->tanggal }}</td>
								<td>{{ $transaction->petugas }}</td>
						</tr>
    			@endforeach --}}
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection

{{-- @push('modal')
@include('cash_transactions.modal.create')
@include('cash_transactions.modal.show')
@include('cash_transactions.modal.edit')

@include('cash_transactions.modal.look-more' )
@endpush

@push('js')
@include('cash_transactions.script')
@endpush --}}
