@component('mail::message')
**Halo {{$nama}}**,

Berikut adalah detail ujian penerimaan mahasiswa baru dan akun akses ujian.

## Akun Akses
    - Kode Pendaftaran : {{ $kode }}
    - Kata sandi : {{ $password }}

## Detail Ujian
    - Tanggal Mulai Ujian : {{ $tanggalMulaiUjian }}
    - Tanggal Selesai Ujian : {{ $tanggalSelesaiUjian }}
    - Durasi ujian dihitung dari selisih antara jam tanggal mulai dan jam tanggal selesai

## Tata Cara Ujian
    - Login atau masuk menggunakan akun akses yg sudah diberikan di atas
    - Login lebih baik 30 menit sebelum ujian dimulai
    - Masuk pada menu ujian » soal
    - Kemudian cari soal menggunakan Kode Soal yang ada di atas
    - Setelah soal ditemukan, lalu klik mulai ujian kemudian masukkan token
    - Kemudian klik mulai ujian untuk mengisi ujian
    - Di dalam ujian terdapat pertanyaan pilihan ganda dan benar-salah
    - Durasi ujian ditentukan dari selisih antara tanggal mulai ujian dan tanggal selesai ujian

@component('mail::button', ['url' => 'http://pmb.stmik-bandung.online/pmb'])
Mulai Ujian
@endcomponent

@endcomponent
