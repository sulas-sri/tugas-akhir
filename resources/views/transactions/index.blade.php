@extends('layouts.main', ['title' => 'Transaksi', 'page_heading' => 'Data Transaksi'])

@section('content')
    <section class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-4">
                            <div class="stats-icon green">
                                <i class="iconly-boldProfile"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <h6 class="text-muted font-semibold">Pemasukan</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ $incomeAmount }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-4">
                            <div class="stats-icon blue">
                                <i class="iconly-boldProfile"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <h6 class="text-muted font-semibold">Pengeluaran</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ $expenseAmount }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('utilities.alert-flash-message')
        @if (auth()->check() &&
                !auth()->user()->hasRole('headmaster'))
            <div class="col card px-3 py-3">

                <div class="d-flex justify-content-end pb-3">
                    <div class="btn-group d-gap gap-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addTransactionModal">
                            <i class="bi bi-plus-circle"></i> Tambah Transaksi
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm w-100" id="datatable">
                        <thead>
                            <tr>
                                <th scope=" col">#</th>
                                <th scope="col">Tipe Transaksi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        @endif
    </section>
@endsection

@push('modal')
    @include('transactions.modal.create')
    @include('transactions.modal.show')
    @include('transactions.modal.edit')
@endpush

@push('js')
    @include('transactions.script')
@endpush
