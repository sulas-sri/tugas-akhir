<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'student_id' => 'required|array',
            'student_id.*' => 'required|exists:students,id',
            'id_telegram' => 'required|string|max:15',
            'bill' => 'required|numeric|min:0',
            // 'date' => 'required|date',
            'kategori_tagihan' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Kolom siswa wajib diisi.',
            'student_id.array' => 'Kolom siswa harus berupa array.',
            'student_id.*.required' => 'Kolom siswa wajib diisi untuk semua siswa yang dipilih.',
            'student_id.*.exists' => 'Siswa yang dipilih tidak valid.',
            'id_telegram.required' => 'Kolom ID Telegram wajib diisi.',
            'id_telegram.string' => 'Kolom ID Telegram harus berupa string.',
            'id_telegram.max' => 'Kolom ID Telegram tidak boleh lebih dari :max karakter.',
            'bill.required' => 'Kolom tagihan wajib diisi.',
            'bill.numeric' => 'Kolom tagihan harus berupa angka.',
            'bill.min' => 'Kolom tagihan harus minimal :min.',
            // 'date.required' => 'Kolom tanggal jatuh tempo wajib diisi.',
            'date.date' => 'Kolom tanggal jatuh tempo harus tanggal yang valid.',
            'kategori_tagihan.max' => 'Kolom kategori tagihan tidak boleh lebih dari :max karakter.',
        ];
    }
}
