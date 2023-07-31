<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Billing;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BillingRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\BillingStoreRequest;
use App\Http\Requests\BillingUpdateRequest;
use App\Notifications\TelegramNotification;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Telegram\Bot\Api;

class BillingController extends Controller
{
    private $billingRepository, $startOfWeek, $endOfWeek;

    public function __construct(BillingRepository $billingRepository)
    {
        $this->billingRepository = $billingRepository;
        $this->startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = now()->endOfWeek()->format('Y-m-d');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $billings = Billing::with('students:id,name')
            ->select('id', 'student_id', 'id_telegram', 'bill', 'kategori_tagihan','date')
            ->whereBetween('date', [$this->startOfWeek, $this->endOfWeek])
            ->latest()
            ->get();

        $students = Student::select('id', 'student_identification_number', 'name')
            ->whereDoesntHave(
                'billings',
                fn (Builder $query) => $query->select(['date'])
                    ->whereBetween('date', [$this->startOfWeek, $this->endOfWeek])
            )->get();

        if (request()->ajax()) {
            return datatables()->of($billings)
                ->addIndexColumn()
                ->addColumn('bill', fn ($model) => indonesianCurrency($model->bill))
                ->addColumn('date', fn ($model) => date('d-m-Y', strtotime($model->date)))
                ->addColumn('id_telegram', fn ($model) => $model->id_telegram)
                ->addColumn('kategori_tagihan', fn ($model) => $model->kategori_tagihan)
                ->addColumn('notification', 'billings.datatable.notification')
                ->rawColumns(['notification'])
                ->addColumn('action', 'billings.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $billingTrashedCount = Billing::onlyTrashed()->count();

        return view('billings.index', [
            'billings' => $billings,
            'students' => $students,
            'data' => $this->billingRepository->results(),
            'billingTrashedCount' => $billingTrashedCount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BillingStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BillingStoreRequest $request): RedirectResponse
    {
        foreach ($request->student_id as $student_id) {
            $billing = Auth::user()->billings()->create([
                'student_id' => $student_id,
                'bill' => $request->bill,
                'date' => $request->date,
                'kategori_tagihan' => $request->kategori_tagihan,
                'id_telegram' => $request->id_telegram,
            ]);
        }

        return redirect()->route('billings.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function __invoke()
    {
        // Logika dan proses untuk halaman index billings
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\BillingUpdateRequest  $request
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BillingUpdateRequest $request, Billing $billing): RedirectResponse
    {
        $billing->update($request->validated());

        return redirect()->route('billings.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Billing $billing): RedirectResponse
    {
        $billing->delete();

        return redirect()->route('billings.index')->with('success', 'Data berhasil dihapus!');
    }

    public function sendNotification(Billing $billing)
    {
        // Pastikan ID Telegram tidak kosong
        if ($billing->id_telegram) {
            // Mengirim notifikasi ke chat ID yang telah ditentukan
            $billing->notify(new TelegramNotification($billing->bill, $billing->kategori_tagihan, $billing->id_telegram));
            return redirect()->route('billings.index')->with('success', 'Notifikasi telah dikirim!');
        } else {
            return redirect()->route('billings.index')->with('error', 'Gagal mengirim notifikasi. Tagihan tidak memiliki ID Telegram.');
        }
    }

    public function sendNotificationToAll()
    {
        // Ambil semua data tagihan
        $billings = Billing::all();

        // Buat array untuk menyimpan data tagihan yang berhasil dikirim notifikasi
        $successBillings = [];

        // Looping untuk mengirim notifikasi menggunakan TelegramNotification untuk setiap data tagihan
        foreach ($billings as $billing) {
            // Pastikan ID Telegram tidak kosong sebelum mengirim notifikasi
            if ($billing->id_telegram) {
                $billing->notify(new TelegramNotification($billing->bill, $billing->kategori_tagihan, $billing->id_telegram));
                $successBillings[] = $billing;
            }
        }

        // Jika ada data tagihan yang berhasil dikirim notifikasi, tampilkan pesan berhasil
        if (count($successBillings) > 0) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
