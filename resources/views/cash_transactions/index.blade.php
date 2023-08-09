@extends('layouts.main', ['title' => 'Pembayaran', 'page_heading' => 'Data Pembayaran'])

@section('content')
<section class="row">
	{{-- Start Statistics --}}
	{{-- <div class="col-6 col-lg-6 col-md-6">
		<div class="card">
			<div class="px-3 card-body py-4-4">
				<div class="row">
					<div class="col-md-4">
						<div class="stats-icon">
							<i class="iconly-boldChart"></i>
						</div>
					</div>
					<div class="col-md-8">
						<h6 class="font-semibold text-muted">Total Bulan Ini</h6>
						<h6 class="mb-0 font-extrabold">
							{{ $data['totals']['thisMonth'] }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-6 col-lg-6 col-md-6">
		<div class="card">
			<div class="px-3 card-body py-4-4">
				<div class="row">
					<div class="col-md-4">
						<div class="stats-icon">
							<i class="iconly-boldChart"></i>
						</div>
					</div>
					<div class="col-md-8">
						<h6 class="font-semibold text-muted">Total Tahun Ini</h6>
						<h6 class="mb-0 font-extrabold">
							{{ $data['totals']['thisYear'] }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-6 col-lg-6 col-md-6">
		<div class="card">
			<div class="px-3 card-body py-4-4">
				<div class="row">
					<div class="col-md-4">
						<div class="stats-icon green">
							<i class="iconly-boldActivity"></i>
						</div>
					</div>
					<div class="col-md-8">
						<h6 class="font-semibold text-muted">Sudah Membayar Minggu Ini</h6>
						<h6 class="mb-0 font-extrabold">
							{{ $data['studentCountWho']['paidThisWeek'] }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-6 col-lg-6 col-md-6">
		<div class="card">
			<div class="px-3 card-body py-4-4">
				<div class="row">
					<div class="col-md-4">
						<div class="stats-icon red">
							<i class="iconly-boldActivity"></i>
						</div>
					</div>
					<div class="col-md-8">
						<h6 class="font-semibold text-muted">Belum Membayar Minggu Ini</h6>
						<h6 class="mb-0 font-extrabold">
							{{ $data['studentCountWho']['notPaidThisWeek'] }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 col-lg-12 col-md-12">
		<div class="card">
			<div class="card-header">
				<h4>Belum Membayar Minggu Ini </h4>
			</div>
			@if($data['studentCountWho']['notPaidThisWeek'] > 0)
			<div class="px-4">
				<button type="button" class='mt-3 font-bold btn btn-block btn-xl btn-light-danger'
					data-bs-toggle="modal" data-bs-target="#lookMoreModal">Ada
					<b>{{ $data['studentCountWho']['notPaidThisWeek'] }}</b> orang belum membayar pada minggu
					ini! <i class="bi bi-exclamation-triangle"></i></button>
			</div>

			<span class="mb-3 badge w-100 rounded-pill bg-warning"></span>
			<div class="pb-4 card-content">
				<div class="row">
					@foreach($data['students']['notPaidThisWeekLimit'] as $studentNotPaidThisWeek)
					<div class="col-6 col-lg-6 col-md-6">
						<div class="px-4 py-3 recent-message d-flex">
							<div class="name ms-4">
								<h5 class="mb-1">{{ $studentNotPaidThisWeek->name }}</h5>
								<h6 class="mb-0 text-muted">
									{{ $studentNotPaidThisWeek->student_identification_number }}</h6>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="px-4">
					<button type="button" class='mt-3 font-bold btn btn-block btn-xl btn-light-primary'
						data-bs-toggle="modal" data-bs-target="#lookMoreModal">Lihat
						Selengkapnya</button>
				</div>
			</div>
			@else
			<div class="px-4">
				<p class='my-3 font-bold btn btn-block btn-xl btn-light-success'>Terima kasih! Semua sudah membayar <i
						class="bi bi-emoji-laughing"></i></p>
			</div>
			@endif
		</div>
	</div> --}}
	{{-- End of Statistics --}}

	@include('utilities.alert-flash-message')
	<div class="px-3 py-3 col card">
		<div class="pb-3 d-flex justify-content-end">
			<div class="gap-2 btn-group d-gap">
				<a href="{{ route('cash-transactions.export') }}" class="btn btn-success">
					<i class="bi bi-file-earmark-excel-fill"></i>
					Export Excel
				</a>
				<a href="{{ route('cash-transactions.index.history') }}" class="btn btn-secondary">
					<span class="badge">{{ $cashTransactionTrashedCount }}</span> Histori Data Kas
				</a>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal"
					data-bs-target="#addCashTransactionModal">
					<i class="bi bi-plus-circle"></i> Tambah Data
				</button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-sm w-100" id="datatable">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Pelajar</th>
						<th scope="col">Jumlah Dibayar</th>
						<th scope="col">Kategori Bayar</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection

@push('modal')
@include('cash_transactions.modal.create')
@include('cash_transactions.modal.show')
@include('cash_transactions.modal.edit')

@include('cash_transactions.modal.look-more' )
@endpush

@push('js')
@include('cash_transactions.script')
@endpush
