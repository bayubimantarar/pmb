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
                <a href="/keuangan"><i class="fa fa-dashboard fa-fw"></i> Dasbor</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> PMB Pendaftaran<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/keuangan/biaya-heregistrasi">
                            <i class="fa fa-book"></i> Data Biaya Heregistrasi
                        </a>
                    </li>
                    <li>
                        <a href="/keuangan/gelombang">
                            <i class="fa fa-book"></i> Data Gelombang
                        </a>
                    </li>
                    <li>
                        <a href="/keuangan/biaya">
                            <i class="fa fa-book"></i> Data Biaya Kuliah
                        </a>
                    </li>
                    <li>
                        <a href="/keuangan/potongan">
                            <i class="fa fa-book"></i> Data Potongan
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-book fa-fw"></i> Data Detail Biaya Kuliah <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            @foreach($biaya as $item)
                                <li>
                                    <a href="/keuangan/detail-biaya/{{ $item->id }}"><i class="fa fa-file-text-o"></i> {{ $item->kelas }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-book fa-fw"></i> Data Detail Gelombang <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            @foreach($gelombang as $item)
                                <li>
                                    <a href="/keuangan/detail-gelombang/{{ $item->id }}"><i class="fa fa-file-text-o"></i> {{ $item->nama }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-book fa-fw"></i> Data Detail Potongan <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            @foreach($potongan as $item)
                                <li>
                                    <a href="/keuangan/detail-potongan/{{ $item->id }}"><i class="fa fa-file-text-o"></i> {{ $item->nama }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                    <li>
                        <a href="/keuangan/pendaftaran">
                            <i class="fa fa-book fa-fw"></i> Data Pendaftaran
                        </a>
                    </li>
                    <li>
                        <a href="/keuangan/konfirmasi-pembayaran">
                            <i class="fa fa-book fa-fw"></i> Data Konfirmasi Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="/keuangan/formulir">
                            <i class="fa fa-book fa-fw"></i> Data Formulir
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
