<!-- sellerSidebar.blade.php -->
<div style="width: 250px; height: 100%; margin-top: 70px; background-color: #F1F8FF;" class="sidebar position-fixed">
    <div class="text-center py-3 ">
        <img src="{{ asset('images/user/profile.png') }}" style="width: 50px; height: 50px;" alt="Profile Icon">
        <p class="mb-0 mt-2" style="font-weight: bold;">
            @if (session()->has('user'))
                {{ session('user')->name }}
            @endif 
        </p>
        <a href="/sellerProfile" class="text-decoration-none">Edit Profile</a>
        @if (session('user')->premium_status == 0)
            <div class="d-flex justify-content-center mb-1">
                <p class="mt-1 mb-0" style="width:80px ;background-color: rgb(249, 255, 187); padding: 5px; border-radius: 5px;">Basic</p>
            </div>
            <a href="{{ route('upgrade.status',['id'=>session('user')->id_penjual]) }}" style="text-decoration: none" class="">Upgrade membership</a>
        @else            
            <div class="d-flex justify-content-center">
                <p class="mt-2 mb-0" style="cursor:pointer; width:80px ;background-color: #BBDAFF; padding: 5px; border-radius: 5px;">Premium</p>
            </div>
        @endif

    </div>

    <ul class="list-unstyled ">
        <li class="py-1" style="margin-bottom: 8px;">
            <a href="/dashboard" class="text-decoration-none text-dark fw-bold"><img class="" src="{{ asset('images/user/home.png') }}" style="width: 20px; height: 20px; margin-left: 10px;" alt="home"> Home</a>
        </li>
        <li class="py-1 view overlay" style="margin-bottom: 8px;">
            <a href="/add" class=" text-decoration-none text-dark fw-bold"><img src="{{ asset('images/user/ticket.png') }}" style="  width: 20px; height: 20px; margin-left: 10px;" alt="add-ticket"> Tambah Tiket</a>
        </li>
        <li class="py-1" style="margin-bottom: 8px;">
            <a href="/viewall" class="text-decoration-none text-dark fw-bold"><img src="{{ asset('images/user/view-ticket.png') }}" style="width: 20px; height: 20px; margin-left: 10px;" alt="view-ticket"> Lihat Semua Tiket</a>
        </li>
        <li class="py-1" style="margin-bottom: 8px;">
            <div class="text-decoration-none text-dark fw-bold" style="cursor: pointer;" onclick="toggleLaporan()"><img src="{{ asset('images/user/report.png') }}" style="width: 20px; height: 20px; margin-left: 10px;" alt="report"> Laporan</div>
            <ul id="laporanSubMenu" class="list-unstyled ml-3" style="display: none; margin-left: 20px;">
                <li style="margin-top: 10px; margin-bottom: 10px;"><a href="#" class="text-decoration-none text-dark">Laporan Penjualan</a></li>
                <li style="margin-bottom: 10px;"><a href="#" class="text-decoration-none text-dark">Laporan Cash Flow</a></li>
                <li style="margin-bottom: 10px;"><a href="#" class="text-decoration-none text-dark">Laporan View Ticket</a></li>
            </ul>
        </li>
    </ul>

    <script>
        function toggleLaporan() {
            var laporanSubMenu = document.getElementById('laporanSubMenu');
            laporanSubMenu.style.display = (laporanSubMenu.style.display === 'none') ? 'block' : 'none';
        }
    </script>
</div>