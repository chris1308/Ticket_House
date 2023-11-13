<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('font/font/css/all.min.css') }}">
    <style>
        /* Add your preloader styles here */
        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999; /* Ensure it appears above other elements */
        }


    </style>
    <title>{{ $title }}</title>
</head>
<body>
    
    <div id="loader">
        <div class="wrapper d-flex justify-content-center" style="padding-top: 10%">
            <img style="width:500px;" src="{{ asset('images/loader2.gif') }}" alt="Loader">
        </div>
    </div>
    {{-- navbar dijadikan komponen terpisah di file partials/navbar. Cara panggil komponen pake @include(namafolder.namafile) --}}
    @include('partials.navbar')
    <div class="container-fluid" style="">
        @yield('content')
    </div>
    @include('partials.footer')
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>