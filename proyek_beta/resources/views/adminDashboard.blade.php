@if (session('admin') == "admin")
{{-- adminMain untuk ambil komponen navbar dan sidebar admin --}}
    @extends('layouts.adminMain')
    @section('content')
    <div class="container" style="overflow:hidden; height: 650px; padding-top:100px; margin-left: 300px;">
            <div class="row">
            <div class="col-md-9">
                <h1 class="fw-bold">Dashboard</h1>
            </div>
            </div>
        </div>
    @endsection
@else
    {{-- redirect to admin login page if hasn't logged in --}}
    <script>window.location = "{{ route('login.admin') }}";</script>
@endif

