<?php

// app/Http/Controllers/Export/CetakKwitansiPDFController.php

namespace App\Http\Controllers\Export;

use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use PDF;

class CetakKwitansiPDFController extends Controller
{
    public function cetakKwitansi($id)
    {
        // Ambil data transaksi berdasarkan ID
        $cashTransaction = CashTransaction::with('students')->find($id);

        if (!$cashTransaction) {
            abort(404); // Tampilkan halaman 404 jika objek tidak ditemukan
        }

        // Tampilkan view PDF dengan konten untuk user (orang tua) dan admin
        $pdf = PDF::loadView('cash_transactions.cetak-kwitansi', compact('cashTransaction'));

        // Atur nama file dan jalur penyimpanan jika perlu
        $fileName = 'kwitansi-' . $cashTransaction->transaction_number . '.pdf';

        // Untuk langsung menampilkan PDF di browser
        return $pdf->stream($fileName);

        // Untuk menyimpan PDF di server, uncomment baris berikut:
        // return $pdf->save(public_path('pdf/' . $fileName));
    }
}
