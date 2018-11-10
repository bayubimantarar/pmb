<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class KonfirmasiPembayaran extends Model
{
    protected $table = 'pmb_konfirmasi_pembayaran';
    protected $fillable = [
        'nama',
        'nomor_telepon',
        'email',
        'alamat',
        'tanggal_pembayaran',
        'jumlah_pembayaran',
        'bank_tujuan',
        'nama_rekening_pengirim',
        'bukti_transaksi'
    ];
    protected $dates = [
        'tanggal_pembayaran'
    ];
}
