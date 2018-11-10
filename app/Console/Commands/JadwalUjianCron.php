<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\KirimEmailJadwalUjianJob;

class JadwalUjianCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pmb:email-jadwal-ujian {id} {kodeSoal} {kodeGelombang} {kodeJurusan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending jadwal ujian via email to calon mahasiswa';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->argument('kodeSoal');
        $kodeSoal = $this->argument('kodeSoal');
        $kodeGelombang = $this->argument('kodeGelombang');
        $kodeJurusan = $this->argument('kodeJurusan');

        dispatch(new KirimEmailJadwalUjianJob());
    }
}
