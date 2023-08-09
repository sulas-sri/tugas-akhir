<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\Request;

class RiwayatPembayaranController extends Controller
{
    public function showHistory()
    {
        $user = auth()->user();
        $cash_transactions = $user->cash_transactions;
        return view('siswa.riwayat_pembayaran', compact('cash_transactions'));
    }

    public function showTagihan()
    {
        return view('siswa.tagihan');
    }
}
