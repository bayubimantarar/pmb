@component('mail::message')
**Halo {{$nama}}**,

Terima kasih telah mendaftar sebagai calon mahasiswa di STMIK Bandung.

## Detail Transaksi

- Biaya Pendaftaran **Rp 250.000,-**

## Metode Pembayaran
<center>
    <table>
        <tr>
            <td>BANK</td>
            <td>Nomor Rekening</td>
        </tr>
        <tr>
            <td>
                <img src="/assets/img/mandiri.png" alt="Logo STMIK Bandung" height="45" />
            </td>
            <td>
                1310007899415 a/n STMIK Bandung
            </td>
        </tr>
    </table>
</center>
@component('mail::button', ['url' => '/konfirmasi-pembayaran'])
Konfirmasi Pembayaran
@endcomponent

Terimakasih banyak,<br>
STMIK Bandung
@endcomponent
