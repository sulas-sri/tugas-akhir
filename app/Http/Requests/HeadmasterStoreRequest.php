<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeadmasterStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Di sini Anda dapat menentukan logika untuk menentukan apakah pengguna diperbolehkan untuk membuat akun kepala sekolah.
        // Misalnya, hanya admin yang diperbolehkan untuk membuat akun kepala sekolah.
        // Jika pengguna yang sedang login adalah admin, maka return true, jika bukan, return false.
        // Contoh: return auth()->user()->isAdmin();
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
            'name' => 'required|string',
            'email' => 'required|email|unique:headmasters,email',
            'password' => 'required|min:8',
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
            'name.required' => 'Nama kepala sekolah harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus terdiri dari :min karakter.',
        ];
    }
}
