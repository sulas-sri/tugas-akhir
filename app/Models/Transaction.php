<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'transactions';

    // Kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'type',
        'date',
        'description',
        'amount',
        'user_id',
    ];

    // Relasi ke model User (jika ingin menghubungkan transaksi dengan user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
