<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kwitansi-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            box-sizing: border-box;
        }

        .user-section {
            width: 48%;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .admin-section {
            width: 48%;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="kwitansi-container">
        <div class="user-section">
            <h1>KWITANSI PEMBAYARAN (User)</h1>
            <p>Nomor Transaksi: {{ $cashTransaction->transaction_number }}</p>
            @if ($cashTransaction->student)
                <p>Nama Pelajar: {{ $cashTransaction->student->name }}</p>
            @else
                <p>Nama Pelajar: [Data Pelajar Tidak Tersedia]</p>
            @endif
            <p>Tagihan: {{ $cashTransaction->bill }}</p>
            <p>Total Bayar: {{ $cashTransaction->amount }}</p>
            <p>Tanggal: {{ $cashTransaction->date }}</p>
            <!-- Tambahkan konten lainnya sesuai dengan kebutuhan kwitansi PDF untuk user -->
        </div>
        <div class="admin-section">
            <h1>KWITANSI PEMBAYARAN (Admin)</h1>
            <p>Nomor Transaksi: {{ $cashTransaction->transaction_number }}</p>
            @if ($cashTransaction->student)
                <p>Nama Pelajar: {{ $cashTransaction->student->name }}</p>
            @else
                <p>Nama Pelajar: [Data Pelajar Tidak Tersedia]</p>
            @endif
            <p>Tagihan: {{ $cashTransaction->billing }}</p>
            <p>Total Bayar: {{ $cashTransaction->total_payment }}</p>
            <p>Tanggal: {{ $cashTransaction->date }}</p>
            <!-- Tambahkan konten lainnya sesuai dengan kebutuhan kwitansi PDF untuk admin -->
        </div>
    </div>
</body>
</html>
