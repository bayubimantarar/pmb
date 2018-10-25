@component('mail::message')
**Halo {{$nama}}**,

Terima kasih telah mendaftar sebagai calon mahasiswa di STMIK Bandung.

## Detail Transaksi

- Biaya Pendaftaran **Rp 250.000,-**

## Metode Pembayaran

| BANK                                                                       | Nomor Rekening |
|:---------------------------------------------------------------------:|:-------------------------------:|
| ![logo MANDIRI](https://dev.ujian.bimantara.web.id/assets/img/mandiri.png) | 1370012937001 a/n STMIK Bandung |
| ![logo BCA](https://dev.ujian.bimantara.web.id/assets/img/bca.png) | 0306236012 a/n STMIK Bandung |

@component('mail::button', ['url' => 'http://localhost:8000/pmb/formulir/konfirmasi-pembayaran'])
Konfirmasi Pembayaran
@endcomponent

Terimakasih banyak,<br>
STMIK Bandung
@endcomponent
