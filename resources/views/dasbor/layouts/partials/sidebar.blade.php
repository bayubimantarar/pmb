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
                <a href="/dasbor"><i class="fa fa-dashboard fa-fw"></i> Dasbor</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Dosen<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/dasbor/dosen"><i class="fa fa-bar-chart-o"></i> Data Dosen</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> Jenis Ujian<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/dasbor/jenis-ujian"><i class="fa fa-bar-chart-o"></i> Data Jenis Ujian</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> Mahasiswa<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/dasbor/mahasiswa"><i class="fa fa-bar-chart-o"></i> Data Mahasiswa</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> Mata Kuliah<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="morris.html"><i class="fa fa-bar-chart-o"></i> Data Kuliah</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> Soal<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/dasbor/soal"><i class="fa fa-bar-chart-o"></i> Data Soal</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Pertanyaan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @foreach($soal as $item)
                                    <li>
                                        <a href="/dasbor/pertanyaan/{{ $item->kode }}">{{ $item->kode_jenis_ujian }} - {{ $item->nama_mata_kuliah }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- /.nav-second-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
