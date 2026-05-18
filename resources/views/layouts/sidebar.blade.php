<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">

    <div class="sidebar-brand">
      <a href="{{ route('dashboard') }}">Stisla</a>
    </div>

    <ul class="sidebar-menu">

      {{-- DASHBOARD --}}
      <li class="menu-header">Dashboard</li>

      <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Dashboard</span>
        </a>
      </li>

      @auth
      @if(auth()->user()->role == 'admin')

      {{-- MANAJEMEN USER --}}
      <li class="menu-header">Manajemen User</li>

      <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}" class="nav-link">
          <i class="fas fa-users"></i>
          <span>Data User</span>
        </a>
      </li>

      {{-- MASTER DATA --}}
      <li class="menu-header">Master Data</li>

      {{-- DATA Genre --}}
      <li class="{{ Request::is('genre*') ? 'active' : '' }}">
        <a href="{{ route('genre.index') }}" class="nav-link">
          <i class="fas fa-school"></i>
          <span>Data Genre</span>
        </a>
      </li>

      <li class="{{ Request::is('pengarang*') ? 'active' : '' }}">
      <a href="{{ route('pengarang.index') }}" class="nav-link">
        <i class="fas fa-user-edit"></i>
        <span>Data Pengarang</span>
      </a>
    </li>

    {{-- Data Rak Buku --}}
<li class="{{ Request::is('rak_buku*') ? 'active' : '' }}">

  <a href="{{ route('rak_buku.index') }}"
     class="nav-link">

    <i class="fas fa-archive"></i>

    <span>Data Rak Buku</span>

  </a>

</li>

{{-- Data Penerbit --}}
<li class="{{ Request::is('penerbit*') ? 'active' : '' }}">

  <a href="{{ route('penerbit.index') }}"
     class="nav-link">

    <i class="fas fa-building"></i>

    <span>Data Penerbit</span>

  </a>

</li>

{{-- Data Buku --}}
<li class="{{ Request::is('buku*') ? 'active' : '' }}">

  <a href="{{ route('buku.index') }}"
     class="nav-link">

    <i class="fas fa-book"></i>

    <span>Data Buku</span>

  </a>

</li>
      @endif
      @endauth

  {{-- PEMINJAMAN --}}
  <li class="menu-header">Peminjaman</li>

      @if(in_array(auth()->user()->role, ['admin', 'anggota']))
<li class="{{ Request::is('peminjaman*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('peminjaman.index') }}">
        <i class="fas fa-book-reader"></i>
        <span>Peminjaman</span>
    </a>
</li>
@endif

@if(in_array(auth()->user()->role, ['admin', 'petuggas']))
<li class="{{ Request::is('transaksi-peminjaman*') ? 'active' : '' }}">

    <a class="nav-link"
       href="{{ route('peminjaman.transaksi') }}">

        <i class="fas fa-exchange-alt"></i>

        <span>Transaksi Peminjaman</span>

    </a>

</li>
@endif


      {{-- ACCOUNT --}}
      <li class="menu-header">Account</li>

      @guest
      <li>
        <a href="{{ route('login') }}" class="nav-link">
          <i class="far fa-user"></i>
          <span>Login</span>
        </a>
      </li>
      @endguest

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