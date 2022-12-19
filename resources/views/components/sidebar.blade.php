<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('dashboard-general-dashboard') }}">Sarpras</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('dashboard-general-dashboard') }}">PNJ</a>
        </div>

        @if(auth()->user()->role == 'admin')
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown ">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard Admin</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('dashboard-general-dashboard') }}">Home</a>
                    </li>
                    <li class='{{ Request::is('barang') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('barang') }}">Barang</a>
                    </li>
                    <li class='{{ Request::is('peminjaman') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('peminjaman') }}">Peminjam</a>
                    </li>
                    <li class='{{ Request::is('user') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('user') }}">User</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="menu-header">More</li>
            <li class="nav-item dropdown">
                <a href="#"
                class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i><span>Features</span></a>
                <ul class="dropdown-menu">
                <li class='{{ Request::is('webcam') ? 'active' : '' }}'>
                    <a class="nav-link"
                        href="{{ url('webcam') }}">Webcam</a>
                </li>
            </ul>
            </li> --}}
        </ul>
        @endif

        @if(auth()->user()->role == 'mahasiswa')
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown ">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard Mahasiswa</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('dashboard-general-dashboard') }}">Home</a>
                    </li>
                    <li class='{{ Request::is('baranguser') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('baranguser') }}">List Barang</a>
                    </li>
                    <li class='{{ Request::is('history') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('history') }}">History</a>
                    </li>
                </ul>
            </li>
        </ul>
        @endif
        {{-- <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> --}}
    </aside>
</div>
