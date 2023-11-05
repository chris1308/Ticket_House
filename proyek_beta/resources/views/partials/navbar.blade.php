<div style="position: relative;" class="Navbar d-flex justify-content-between bg-white container-fluid pt-3 shadow p-3 mb-4">
    <div class="WebLogo">
        
        <span class="fw-bold" style="font-size:23px; cursor:pointer;"><a href="/" class="nav-link">🎟️Ticket House</a></span>
    </div>
    <div class="SearchBar " >
        <form class="d-flex">
            <input class="form-control me-1" size="30"  type="search" placeholder="Cari acara atau lokasi" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
    </div>
    {{-- navbarexpandlg supaya menu bisa nyamping dan ngga kebawah --}}
    <div class="Menu navbar-expand-lg">
        {{-- navbar nav supaya tidak ada bullet point --}}
        <ul class="navbar-nav  ">
            <li class="nav-item mx-2">
              <a class="nav-link active" aria-current="page" href="#">Seminar</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#">Places</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="/about">About Us</a>
            </li>
            <li class="nav-item mx-2">
              <a class="btn btn-success" href="/login" >Login</a>
            </li>
        </ul>
    </div>
</div>