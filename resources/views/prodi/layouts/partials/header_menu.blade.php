<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> {{ Auth::Guard('prodi')->User()->nama }}</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Pengaturan</a>
            </li>
            <li class="divider"></li>
            <li><a href="/prodi/autentikasi/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                <form 
                  id="logout-form" 
                  action="/prodi/autentikasi/logout" 
                  method="POST" 
                  style="display: none;"
                >
                    @csrf
                </form>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->
