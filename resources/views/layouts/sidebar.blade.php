<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">

    <div class="sidebar-brand">
      <a href="{{ url('/') }}">Stisla</a>
    </div>

    <ul class="sidebar-menu">

      <li class="menu-header">Dashboard</li>
      <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="fas fa-fire"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="menu-header">Pages</li>
@guest
<li>
  <a href="{{ route('login') }}" class="nav-link">
    <i class="far fa-user"></i> Login
  </a>
</li>
@endguest

@auth
<li>
  <a href="#" class="nav-link text-danger"
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i> Logout
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</li>
@endauth

    </ul>

  </aside>
</div>