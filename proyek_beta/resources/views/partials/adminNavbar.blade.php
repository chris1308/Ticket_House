<div style="" class="fixed-top Navbar d-flex justify-content-between bg-white container-fluid pt-3 shadow p-3 mb-4">
    <div class="WebLogo">
        
        <span class="fw-bold" style="font-size:23px; cursor:pointer;"><a href="/" class="nav-link">🎟️Ticket House</a></span>
    </div>

    {{-- navbarexpandlg supaya menu bisa nyamping dan ngga kebawah --}}
    <div class="Menu navbar-expand-lg">
        {{-- navbar nav supaya tidak ada bullet point --}}
        <ul class="navbar-nav  ">
            <li class="nav-item mx-2">
            <a href="#" class=" fw-bold nav-link">ADMIN</a>
            </li>
            <li class="nav-item mx-2">
                <img src="{{ asset('images/admin/profile-admin.png') }}" alt="Profile Admin" class="admin-image">
            </li>
        </ul>
    </div>
</div>