<div style="" class="fixed-top Navbar d-flex justify-content-between bg-light container-fluid pt-3 shadow p-3 mb-4 navbar-expand-lg">
    <div class="WebLogo">
        <span class="fw-bold" style="font-size:23px; cursor:pointer;"><a href="/home" class="nav-link">🎟️Ticket House</a></span>
    </div>
    <div class="SearchBar " >
        <form class="d-flex">
            <input class="form-control me-1" size="25"  type="search" placeholder="Cari acara atau lokasi" aria-label="Search">
            <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
    </div>
    {{-- navbarexpandlg supaya menu bisa nyamping dan ngga kebawah --}}
    <div class="Menu navbar-expand-lg">
        {{-- navbar nav supaya tidak ada bullet point --}}
        <ul class="navbar-nav">
        @if (session()->has('user')) 
          <li class="nav-item mx-3">
            <a class="nav-link" style="opacity: {{ request()->is('history') ? '100%' : '50%' }}" href="#">History</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" style="opacity: {{ request()->is('wishlist') ? '100%' : '50%' }}" href="#">Wishlist</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" style="opacity: {{ request()->is('nearme') ? '100%' : '50%' }}" href="#"><i class="fa-solid fa-location-dot"></i> Near Me</a>
          </li>
          <li class="nav-item mx-3">
            <!-- {{-- untuk mendapatkan path route yang sedang dikunjungi lalu dibuat active--}} -->
            <a class="nav-link {{ request()->is('seminar') ? 'active' : '' }}" style="opacity: {{ request()->is('seminar') ? '100%' : '50%' }}" href="/seminar">Seminar</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link {{ request()->is('places') ? 'active' : '' }}" style="opacity: {{ request()->is('places') ? '100%' : '50%' }}" href="/places">Places</a>
          </li>
          <li class="nav-item mx-3">
            <!-- {{-- Mengatur style agar menu page yang aktif bisa dibedakan dari menu page lain  --}} -->
            <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" 
            style="opacity: {{ request()->is('about') ? '100%' : '50%' }}" href="/about">About Us</a>
          </li>
          <li class="nav-item mx-3">
            <a class="nav-link" href="#" ><i class="fa-regular fa-bell fa-xl"></i></a>
          </li>
          <li class="nav-item dropdown mx-3">
            {{-- if we add class dropdown-toggle, there will be a dropdown arrow displayed next to user profile --}}
            <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-user fa-xl"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="fa-solid fa-dollar-sign fa-lg"></i>&nbsp; {{ session('user')->poin }} Points</a></li>
              <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square fa-lg"></i> Edit Profile</a></li>
              <li><a class="dropdown-item" style="cursor: pointer">Refferal Code : {{ session('user')->refferal }}</a></li>
              <li><hr class="dropdown-divider"></li>
              {{-- dropdown divider is a separator line, like <hr> tag --}}
              <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
          </li>
          @else          
            <li class="nav-item mx-2">
              <a class="nav-link {{ request()->is('seminar') ? 'active' : '' }}" aria-current="page" style="opacity: {{ request()->is('seminar') ? '100%' : '50%' }}" href="/seminar">Seminar</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link {{ request()->is('places') ? 'active' : '' }}" style="opacity: {{ request()->is('places') ? '100%' : '50%' }}" href="/places">Places</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" style="opacity: {{ request()->is('about') ? '100%' : '50%' }}" href="/about">About Us</a>
            </li>
            <li class="nav-item mx-2">
              <a class="btn btn-success" href="/login" >Login</a>
            </li>  
          @endif
        </ul>
    </div>
</div>