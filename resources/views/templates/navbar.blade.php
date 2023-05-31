<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ Request()->segment('1') == 'home' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('/home') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request()->segment(1) == 'profile' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('/profile', auth()->user()->id) }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
                </a>
            </li>
            @if (hasRole() == 'Admin')
                <li class="sidebar-item {{ Request()->segment('2') == 'Admin' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('user.show', 'Admin') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data Admin</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request()->segment('2') == 'User' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('user.show', 'User') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data User</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request()->segment('1') == 'pengaduan' || Request()->segment('1') == 'tanggapi-pengaduan' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('pengaduan.create') }}">
                        <i class="align-middle" data-feather="table"></i> <span class="align-middle">Semua Data
                            Pengaduan</span>
                    </a>
                </li>
            @elseif (hasRole() == 'User')
                <li class="sidebar-item {{ Request()->segment('1') == 'table-user' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('user.show', 'User') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data User</span>
                    </a>
                </li>
            @endif

            <li class="sidebar-header">
                Pengaduan
            </li>

            @if (hasRole() == 'User')
                <li class="sidebar-item {{ Request()->segment('1') == 'form-pengaduan' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('form-pengaduan') }}">
                        <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms
                            Pengaduan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request()->segment('1') == 'pengaduan' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('pengaduan.show', auth()->user()->id) }}">
                        <i class="align-middle" data-feather="table"></i> <span class="align-middle">Data
                            Pengaduan Saya</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request()->segment('1') == 'table-pengaduan-ditanggapi' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ url('table-pengaduan-ditanggapi', auth()->user()->id) }}">
                        <i class="align-middle" data-feather="table"></i> <span class="align-middle">Pengaduan ditanggapi</span>
                    </a>
                </li>
            @endif



        </ul>

    </div>
</nav>
