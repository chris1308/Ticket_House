<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('font/font/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <title>{{ $title }}</title>
</head>
<style>
  .content {
    padding: 20px;   
  }
  #myTable_wrapper{
            width: 82%;
        }
  #myTable_filter, #myTable_length{
      margin-bottom: 2%;
      margin-top: 2%;
  }
  #myTable_paginate, .dt-buttons{
      margin-top: 2%;
  }
.content h1 {
  font-size: 24px;
  margin-top: 100px;    
  margin-left: 100px;
}

.sidebarMenu:hover{
  background-color: #FDD991;
}

.sidebarMainMenu:hover{
  background-color: #FD9191;
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                dom:  '<"top"lf>rt<"bottom"Bpi>',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ],         
            });
            $('#myTable').css("width","100%");
        } );
    </script>
</body>
</html>