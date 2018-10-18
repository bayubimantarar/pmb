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
                <a href="/dasbor" class="{{ Request::segment(2) ? 'dasbor' : 'active'}}"><i class="fa fa-dashboard fa-fw"></i> Dasbor</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-calendar fa-fw"></i> Master<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/dasbor/master/prodi"><i class="fa fa-file-text-o"></i> Prodi</a>
                    </li>
                    <li>
                        <a href="/dasbor/master/tahun-ajaran"><i class="fa fa-file-text-o"></i> Tahun Ajaran</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> Pengguna<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/dasbor/pengguna/panitia"><i class="fa fa-file-text-o"></i> Panitia</a>
                    </li>
                    <li>
                        <a href="/dasbor/pengguna/prodi"><i class="fa fa-file-text-o"></i> Prodi</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
