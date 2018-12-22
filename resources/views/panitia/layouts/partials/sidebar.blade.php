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
                <a href="#"><i class="fa fa-book fa-fw"></i> PMB Ujian<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/panitia/pmb/nilai-kelulusan">
                            <i class="fa fa-book fa-fw"></i> Data Nilai Kelulusan
                        </a>
                    </li>
                    <li>
                        <a href="/panitia/pmb/kehadiran">
                            <i class="fa fa-book fa-fw"></i> Data Kehadiran
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Data Jadwal Ujian<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/panitia/pmb/jadwal-ujian">
                                        <i class="fa fa-book fa-fw"></i> Data Jadwal Ujian
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-book fa-fw"></i> Data Peserta <span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-third-level">
                                        @foreach($jadwalUjian as $item)
                                            <li>
                                                <a href="/panitia/pmb/peserta-ujian/{{ $item->kode }}"><i class="fa fa-file-text-o"></i> {{ $item->kode }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Data Jawaban Ujian<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @foreach($jadwalUjian as $item)
                                    <li>
                                        <a href="/panitia/pmb/jawaban-ujian/{{ $item->kode }}"><i class="fa fa-file-text-o"></i> {{ $item->kode }}</a>
                                    </li>
                                @endforeach
                            </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Data Hasil Ujian<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @foreach($jadwalUjian as $item)
                                    <li>
                                        <a href="/panitia/pmb/hasil-ujian/{{ $item->kode }}"><i class="fa fa-file-text-o"></i> {{ $item->kode }}</a>
                                    </li>
                                @endforeach
                            </ul>
                    </li>
                    <li>
                        <a href="/panitia/pmb/laporan">
                            <i class="fa fa-book fa-fw"></i> Laporan
                        </a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
