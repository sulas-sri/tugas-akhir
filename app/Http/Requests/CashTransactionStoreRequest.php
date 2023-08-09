<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashTransactionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => ['required'],
            'amount' => ['required', 'integer', 'digits_between:3,191'],
            'category' => 'required|array', // Memastikan category merupakan array
            'category.*' => 'string', // Memastikan setiap elemen dalam array adalah string
            'date' => ['required', 'date'],
            'note' => ['max:191']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'student_id.required' => 'Kolom nama pelajar wajib diisi!',

            'category.required' => 'Kategori pembayaran wajib diisi!',

            // 'bill.required' => 'Kolom tagihan wajib diisi!',

            'amount.required' => 'Kolom total bayar wajib diisi!',
            'amount.integer' => 'Kolom total bayar harus angka!',
            'amount.digits_betweeen' => 'Kolom total bayar harus diantara 3 sampai dengan 191 karakter!',

            'date.required' => 'Kolom tanggal wajib diisi!',
            'date.date' => 'Kolom tanggal harus tanggal yang benar!',

            'note.max' => 'Kolom catatan maksimal 191 karakter!'
        ];
    }
}
