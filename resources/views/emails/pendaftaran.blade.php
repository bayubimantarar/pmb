@component('mail::message')
Terima kasih telah mendaftar sebagai calon mahasiswa di STMIK Bandung.

Selanjutnya silahkan isi formulir yang ada pada link di bawah ini.
@component('mail::button', ['url' => 'http://localhost:8000/pmb/formulir/'.$encryptID])
Isi formulir
@endcomponent

Terimakasih banyak,<br>
STMIK Bandung
@endcomponent
