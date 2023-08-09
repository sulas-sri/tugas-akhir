<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi keuangan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Menghitung jumlah pemasukan
        $incomeAmount = Transaction::where('type', 'pemasukan')->sum('amount');

        // Menghitung jumlah pengeluaran
        $expenseAmount = Transaction::where('type', 'pengeluaran')->sum('amount');

        // Mengambil data transaksi untuk ditampilkan di tabel
        $transactions = Transaction::latest()->get();

        return view('transactions.index', compact('incomeAmount', 'expenseAmount', 'transactions'));
    }

    /**
     * Menampilkan formulir tambah transaksi keuangan.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Menyimpan transaksi keuangan baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TransactionStoreRequest $request)
    {
        // Create a new Transaction model and fill it with the form data
        $transaction = new Transaction([
            'type' => $request->type,
            'date' => $request->date,
            'amount' => $request->amount,
            'description' => $request->description,
            // Fill other attributes as needed
        ]);

        // Save the transaction to the database

        return redirect()->route('transactions.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir edit transaksi keuangan.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\View\View
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Memperbarui transaksi keuangan dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $transaction->update([
            'type' => $request->type,
            'date' => $request->date,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi keuangan berhasil diperbarui!');
    }

    /**
     * Menghapus transaksi keuangan dari database.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi keuangan berhasil dihapus!');
    }



}
