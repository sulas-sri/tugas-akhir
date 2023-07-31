<?php

namespace App\Contracts;

interface BillingInterface
{
    /**
     * Ambil seluruh data paling terbaru pada tabel billings pada database.
     *
     * Jika $limit === null maka tampilkan seluruh data billings tanpa limit.
     * Jika $limit !== null maka tampilkan seluruh data billings dengan limit.
     *
     * @param array $columns kolom apa saja yang ingin difetch.
     * @param int $limit limit data yang ingin ditampilkan.
     * @return Object
     */
    public function billingLatest(array $columns, ?int $limit): Object;

    /**
     * Hitung total kolom amount di tabel billings berdasarkan tahun atau bulan.
     *
     * Jika $status === 'year' dan variabel $year ada isinya, maka hitung total kolom amount di tabel billings berdasarkan
     * tahun sesuai di parameter.
     *
     * Jika $status === 'month' dan variabel $month ada isinya, maka hitung total kolom amount di tabel billings berdasarkan bulan
     * sesuai di parameter.
     *
     * Jika $status === 'year' maka hanya isi parameter $year.
     * jika $status === 'month' maka hanya isi parameter $month.
     *
     * @param string $status ingin hitung total kolom berdasarkan tahun 'year' atau bulan 'month'.
     * @param string $year adalah tahun, contoh : 2021, 2022, 2023, dst..
     * @param string $month adalah bulan dengan 0, contoh : 01, 02, 03, dst..
     * @return int
     */
    public function sumAmountBy(string $status, string $year = null, string $month = null): int;

    /**
     * Hitung siswa yang sudah membayar pada minggu ini.
     *
     * @return int
     */
    public function countStudentWhoPaidThisWeek(): int;

    /**
     * Hitung siswa yang belum membayar pada minggu ini.
     *
     * @return int
     */
    public function countStudentWhoNotPaidThisWeek(): int;

    /**
     * Ambil data siswa yang belum membayar tagihan pada minggu ini.
     *
     * Jika limit === null maka tampilkan seluruh data siswa yang belum membayar minggu ini.
     * Jika limit !== null maka tampilkan data siswa yang belum membayar minggu ini dengan limit.
     *
     * @param int $limit limit data yang akan ditampilkan.
     * @param string $order urutkan data berdasarkan kolom/field di database.
     * @return Object
     */
    public function getStudentWhoNotPaidThisWeek(?int $limit, string $order): Object;

    /**
     * Mengembalikan seluruh data yang dibutuhkan
     *
     * @return array
     */
    public function results(): array;
}
