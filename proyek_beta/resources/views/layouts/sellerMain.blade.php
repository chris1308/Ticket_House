<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    {{-- untuk impor font awesome icons --}}
    <link rel="stylesheet" href="{{ asset('font/font/css/all.min.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    {{-- navbar dijadikan komponen terpisah di file partials/navbar. Cara panggil komponen pake @include(namafolder.namafile) --}}
    @include('partials.sellerNavbar')
    @include('partials.sellerSidebar')

    <div class="container-fluid" style="overflow:hidden;">
        @yield('content')
        @yield('profile')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>