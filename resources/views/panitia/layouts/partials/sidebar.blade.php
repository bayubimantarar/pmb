<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="/panitia"><i class="fa fa-dashboard fa-fw"></i> Dasbor</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> PMB<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/panitia/pmb/gelombang"><i class="fa fa-book"></i> Data Gelombang</a>
                    </li>
                    <li>
                        <a href="/panitia/pmb/biaya"><i class="fa fa-book"></i> Data Biaya</a>
                    </li>
                    <li>
                        <a href="/panitia/pmb/pendaftaran"><i class="fa fa-book fa-fw"></i> Data Pendaftaran</a>
                    </li>
                     <li>
                        <a href="/panitia/pmb/nilai-kelulusan"><i class="fa fa-book fa-fw"></i> Data Nilai Kelulusan</a>
                    </li>
                    <li>
                        <a href="/panitia/pmb/jadwal-ujian"><i class="fa fa-book fa-fw"></i> Data Jadwal Ujian</a>
                    </li>
                    <li>
                        <a href="/panitia/pmb/hasil-ujian"><i class="fa fa-book fa-fw"></i> Data Hasil Ujian</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            {{-- <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> Periksa Jawaban<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Soal<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @foreach($soal as $item)
                                    <li>
                                        <a href="/dosen/periksa/{{ $item->kode }}"><i class="fa fa-file-text-o"></i> {{ $item->kode_jenis_ujian }} - {{ $item->nama_mata_kuliah }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- /.nav-second-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> Nilai<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Soal<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @foreach($soal as $item)
                                    <li>
                                        <a href="/dosen/nilai/{{ $item->kode }}"><i class="fa fa-file-text-o"></i> {{ $item->kode_jenis_ujian }} - {{ $item->nama_mata_kuliah }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- /.nav-second-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li> --}}
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->