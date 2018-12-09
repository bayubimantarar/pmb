@component('mail::message')
**Halo {{$nama}}**,

Berikut adalah detail ujian penerimaan mahasiswa baru dan akun akses ujian.

## Akun Akses
    - Kode Pendaftaran : {{ $kode }}
    - Kata sandi : {{ $password }}

## Detail Ujian
    - Kode Soal : {{ $kodeJadwalUjian }}
    - Tanggal Mulai Ujian : {{ $tanggalMulaiUjian }}
    - Tanggal Selesai Ujian : {{ $tanggalSelesaiUjian }}
    - Durasi ujian : {{ $durasi }} Menit
    - Tempat Ujian : Kampus STMIK Bandung

## Tata Cara Ujian
    - Login atau masuk menggunakan akun akses yg sudah diberikan di atas
    - Login lebih baik 30 menit sebelum ujian dimulai
    - Masuk pada menu ujian » soal
    - Kemudian cari soal menggunakan Kode Soal yang ada di atas
    - Setelah soal ditemukan, lalu klik mulai ujian kemudian masukkan token (Token akan diberitahukan oleh petugas)
    - Kemudian klik mulai ujian untuk mengisi ujian
    - Di dalam ujian terdapat pertanyaan pilihan ganda dan benar-salah

@endcomponent
