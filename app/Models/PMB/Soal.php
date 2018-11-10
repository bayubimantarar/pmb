<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'pmb_soal';
    protected $fillable = [
        'kode',
        'kode_tahun_ajaran',
        'nidn',
        // 'tanggal_mulai_ujian',
        // 'tanggal_selesai_ujian',
        'jumlah_pertanyaan'
    ];
    // protected $dates = [
    //     'tanggal_mulai_ujian',
    //     'tanggal_selesai_ujian'
    // ];

    public function scopeAllDataWithRelationship($query, $nidn)
    {
        $getSoal = $query
            ->select(
                'pmb_soal.*'
            )
            ->where('pmb_soal.nidn', '=', $nidn)
            ->get();
        
        return $getSoal;
    }
}
