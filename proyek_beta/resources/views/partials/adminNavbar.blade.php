
{{-- Navbar Content --}}
<div class="fixed-top Navbar d-flex justify-content-between bg-white container-fluid pt-3 shadow p-3 mb-4">
    <div class="WebLogo">
        <span class="fw-bold" style="font-size:23px; cursor:pointer;"><a href="/" class="nav-link">🎟️Ticket House</a></span>
    </div>

    <div class="Menu navbar-expand-lg">
        <ul class="navbar-nav  ">
            <li class="nav-item mx-2">
                <a href="#" class=" fw-bold nav-link" style="margin-top: 15px;">ADMIN</a>
            </li>
            <li class="nav-item mx-3 mt-1">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/admin/profile-admin.png') }}" alt="Profile Admin" class="admin-image">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-light" href="#" style="background-color: #FB3E3E; font-weight: bold">Logout</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>