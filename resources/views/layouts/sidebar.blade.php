<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        {{-- BRAND --}}
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">
                Stisla
            </a>
        </div>

        <ul class="sidebar-menu">

            {{-- DASHBOARD --}}
            <li class="menu-header">
                Dashboard
            </li>

            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">

                <a href="{{ route('dashboard') }}"
                   class="nav-link">

                    <i class="fas fa-fire"></i>

                    <span>Dashboard</span>

                </a>

            </li>

            {{-- ====================================================== --}}
            {{-- ADMIN --}}
            {{-- ====================================================== --}}

            @auth

            @if(auth()->user()->role == 'admin')

                {{-- MANAJEMEN USER --}}
                <li class="menu-header">
                    Manajemen User
                </li>

                <li class="{{ Request::is('users*') ? 'active' : '' }}">

                    <a href="{{ route('users.index') }}"
                       class="nav-link">

                        <i class="fas fa-users"></i>

                        <span>Data User</span>

                    </a>

                </li>

                {{-- MASTER DATA --}}
                <li class="menu-header">
                    Master Data
                </li>

                {{-- GENRE --}}
                <li class="{{ Request::is('genre*') ? 'active' : '' }}">

                    <a href="{{ route('genre.index') }}"
                       class="nav-link">

                        <i class="fas fa-school"></i>

                        <span>Data Genre</span>

                    </a>

                </li>

                {{-- PENGARANG --}}
                <li class="{{ Request::is('pengarang*') ? 'active' : '' }}">

                    <a href="{{ route('pengarang.index') }}"
                       class="nav-link">

                        <i class="fas fa-user-edit"></i>

                        <span>Data Pengarang</span>

                    </a>

                </li>

                {{-- RAK BUKU --}}
                <li class="{{ Request::is('rak_buku*') ? 'active' : '' }}">

                    <a href="{{ route('rak_buku.index') }}"
                       class="nav-link">

                        <i class="fas fa-archive"></i>

                        <span>Data Rak Buku</span>

                    </a>

                </li>

                {{-- PENERBIT --}}
                <li class="{{ Request::is('penerbit*') ? 'active' : '' }}">

                    <a href="{{ route('penerbit.index') }}"
                       class="nav-link">

                        <i class="fas fa-building"></i>

                        <span>Data Penerbit</span>

                    </a>

                </li>

                {{-- BUKU --}}
                <li class="{{ Request::is('buku*') ? 'active' : '' }}">

                    <a href="{{ route('buku.index') }}"
                       class="nav-link">

                        <i class="fas fa-book"></i>

                        <span>Data Buku</span>

                    </a>

                </li>

            @endif

            {{-- ====================================================== --}}
            {{-- PEMINJAMAN --}}
            {{-- ====================================================== --}}

            <li class="menu-header">
                Peminjaman
            </li>

            {{-- MENU PEMINJAMAN --}}
            @if(in_array(auth()->user()->role, ['admin', 'anggota']))

                <li class="{{ Request::is('peminjaman*') ? 'active' : '' }}">

                    <a href="{{ route('peminjaman.index') }}"
                       class="nav-link">

                        <i class="fas fa-book-reader"></i>

                        <span>Peminjaman</span>

                    </a>

                </li>

            @endif

            {{-- MENU TRANSAKSI --}}
            @if(in_array(auth()->user()->role, ['admin', 'petugas']))

                <li class="{{ Request::is('transaksi-peminjaman*') ? 'active' : '' }}">

                    <a href="{{ route('peminjaman.transaksi') }}"
                       class="nav-link">

                        <i class="fas fa-exchange-alt"></i>

                        <span>Transaksi</span>

                    </a>

                </li>

            @endif

            {{-- ====================================================== --}}
            {{-- RIWAYAT --}}
            {{-- ====================================================== --}}

            @if(in_array(auth()->user()->role, ['admin', 'anggota']))

                <li class="menu-header">
                    Riwayat
                </li>

                <li class="{{ Request::is('riwayat-peminjaman*') ? 'active' : '' }}">

                    <a href="{{ route('peminjaman.riwayat') }}"
                       class="nav-link">

                        <i class="fas fa-history"></i>

                        <span>Riwayat</span>

                    </a>

                </li>

            @endif

            {{-- ====================================================== --}}
            {{-- PENGEMBALIAN --}}
            {{-- ====================================================== --}}

            @if(in_array(auth()->user()->role, ['admin', 'anggota']))

                <li class="menu-header">
                    Pengembalian
                </li>

                <li class="{{ Request::is('pengembalian*') ? 'active' : '' }}">

                    <a href="{{ route('peminjaman.pengembalian') }}"
                       class="nav-link">

                        <i class="fas fa-undo"></i>

                        <span>Pengembalian</span>

                    </a>

                </li>

            @endif

            @endauth

            {{-- ====================================================== --}}
            {{-- ACCOUNT --}}
            {{-- ====================================================== --}}

            <li class="menu-header">
                Account
            </li>

            {{-- LOGIN --}}
            @guest

                <li>

                    <a href="{{ route('login') }}"
                       class="nav-link">

                        <i class="far fa-user"></i>

                        <span>Login</span>

                    </a>

                </li>

            @endguest

            {{-- LOGOUT --}}
            @auth

                <li>

                    <a href="#"
                       class="nav-link text-danger"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">

                        <i class="fas fa-sign-out-alt"></i>

                        <span>Logout</span>

                    </a>

                    <form id="logout-form"
                          action="{{ route('logout') }}"
                          method="POST"
                          style="display: none;">

                        @csrf

                    </form>

                </li>

            @endauth

        </ul>

    </aside>
</div>