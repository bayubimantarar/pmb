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
                <a href="/dosen"><i class="fa fa-dashboard fa-fw"></i> Dasbor</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> Soal<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/prodi/pmb/soal"><i class="fa fa-book"></i> Data Soal</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Pertanyaan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @foreach($soal as $item)
                                    <li>
                                        <a href="/prodi/pmb/soal/pertanyaan/{{ $item->kode }}"><i class="fa fa-file-text-o"></i> {{ $item->kode }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- /.nav-second-level -->
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
