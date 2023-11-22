<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('font/font/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ $title }}</title>
</head>
<style>
    .content {
  padding: 20px;
}

.content h1 {
  font-size: 24px;
  margin-top: 100px;    
  margin-left: 100px;
}
</style>
<body>
{{-- navbar dijadikan komponen terpisah di file partials/navbar. Cara panggil komponen pake @include(namafolder.namafile) --}}
    @include('partials.adminNavbar')
    @include('partials.adminSidebar')

    <div class="container-fluid" style="overflow:hidden;">
        @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>