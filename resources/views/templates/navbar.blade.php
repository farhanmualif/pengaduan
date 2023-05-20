<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ Request()->segment('1') == 'index' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('/index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request()->segment(1) == 'profile' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('/profile') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>
            @if (hasRole() == 'Admin')
                <li class="sidebar-item {{ Request()->segment('1') == 'table-admin' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ url('table-admin') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data Admin</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request()->segment('1') == 'table-user' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ url('table-user') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data User</span>
                    </a>
                </li>
            @elseif (hasRole() == 'User')
                <li class="sidebar-item {{ Request()->segment('1') == 'table-user' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ url('table-user') }}">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data User</span>
                    </a>
                </li>
            @endif
            <li class="sidebar-item {{ Request()->segment('1') == 'table-pengaduan' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('table-pengaduan') }}">
                    <i class="align-middle" data-feather="table"></i> <span class="align-middle">Data
                        Pengaduan</span>
                </a>
            </li>


            <li class="sidebar-header">
                Tools & Components
            </li>

            @if (hasRole() == 'User')
                <li class="sidebar-item {{ Request()->segment('1') == 'form-pengaduan' ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('form-pengaduan') }}">
                        <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms
                            Pengaduan</span>
                    </a>
                </li>
            @endif


        </ul>

    </div>
</nav>
