<?php

namespace App\Repositories;

use App\Contracts\BillingInterface;
use App\Models\Student;
use App\Models\Billing;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class BillingRepository extends Controller implements BillingInterface
{
    private $model, $students, $startOfWeek, $endOfWeek;

    public function __construct(Billing $model, Student $students)
    {
        $this->model = $model;
        $this->students = $students;
        $this->startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = now()->endOfWeek()->format('Y-m-d');
    }

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
    public function billingLatest(array $columns, ?int $limit): Object
    {
        $model = $this->model->with('students', 'users')->select($columns);

        return is_null($limit)
            ? $model->latest()->get()
            : $model->take($limit)->latest()->get();
    }

    /**
     * Hitung total kolom bill di tabel billings berdasarkan tahun atau bulan.
     *
     * Jika $status === 'year' dan variabel $year ada isinya, maka hitung total kolom bill di tabel billings berdasarkan
     * tahun sesuai di parameter.
     *
     * Jika $status === 'month' dan variabel $month ada isinya, maka hitung total kolom bill di tabel billings berdasarkan bulan
     * sesuai di parameter.
     *
     * Jika $status === 'year' maka hanya isi parameter $year.
     * jika $status === 'month' maka hanya isi parameter $month.
     *
     * @param string $status ingin hitung total kolom berdasarkan tahun 'year' atau bulan 'month'.
     * @param string $year adalah tahun, contoh : 2021, 2022, 2023, dst..
     * @param string $month adalah bulan dengan 0, contoh : 01, 02, 03, dst..
     * @return Int
     */
    public function sumAmountBy(string $status, string $year = null, string $month = null): Int
    {
        $model = $this->model->select('date', 'bill');

        return $status === 'year'
            ? $model->whereYear('date', $year)->sum('bill')
            : $model->whereYear('date', date('Y'))->whereMonth('date', $month)->sum('bill');
    }

    /**
     * Hitung siswa yang sudah membayar pada minggu ini.
     *
     * @return Int
     */
    public function countStudentWhoPaidThisWeek(): Int
    {
        $students = $this->students->select('id');

        $callback = fn (Builder $query) => $query->select(['date'])
            ->whereBetween('date', [$this->startOfWeek, $this->endOfWeek]);

        return $students->whereHas('billings', $callback)->count();
    }

    /**
     * Hitung siswa yang belum membayar pada minggu ini.
     *
     * @return Int
     */
    public function countStudentWhoNotPaidThisWeek(): Int
    {
        $students = $this->students->select('id');

        $callback = fn (Builder $query) => $query->select(['date'])
            ->whereBetween('date', [$this->startOfWeek, $this->endOfWeek]);

        return $students->whereDoesntHave('billings', $callback)->count();
    }

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
    public function getStudentWhoNotPaidThisWeek(?int $limit, string $order): Object
    {
        $students = $this->students->select(['name', 'student_identification_number'])->orderBy($order);

        $callback = fn (Builder $query) => $query->select(['date'])
            ->whereBetween('date', [$this->startOfWeek, $this->endOfWeek]);

        return is_null($limit)
            ? $students->whereDoesntHave('billings', $callback)->get()
            : $students->whereDoesntHave('billings', $callback)->limit($limit)->get();
    }

    /**
     * Mengembalikan seluruh data yang dibutuhkan
     *
     * @return array
     */
    public function results(): array
    {
        return [
            'students' => [
                'notPaidThisWeek' => $this->getStudentWhoNotPaidThisWeek(limit: null, order: 'name'),
                'notPaidThisWeekLimit' => $this->getStudentWhoNotPaidThisWeek(limit: 6, order: 'name'),
            ],
            'studentCountWho' => [
                'paidThisWeek' => $this->countStudentWhoPaidThisWeek(),
                'notPaidThisWeek' => $this->countStudentWhoNotPaidThisWeek(),
            ],
            'totals' => [
                'thisMonth' => indonesianCurrency($this->sumAmountBy('month', month: date('m'))),
                'thisYear' => indonesianCurrency($this->sumAmountBy('year', year: date('Y'))),
            ]
        ];
    }
}
