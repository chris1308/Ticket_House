@extends('layouts.sellerMain')
@section('profile')
    <div class="container" style="height: 650px; padding-top:100px; margin-left: 300px;">
        <h3 class="fw-bold" style="margin-left: 20px;">PROFILE</h3>
        <p style="margin-left: 20px;">CHANGE PROFILE FOR:</p>
        <p class="fw-bold" style="margin-left: 20px;">
            @if (session()->has('user'))
                {{ session('user')->email }}
            @endif 
        </p>
        <div class="row">
            <div class="col-md-4">
                <p style="margin-left: 20px;">PROFILE PICTURE</p>
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <img src="{{ asset('images/user/profile.png') }}" alt="Profile Picture" class="rounded-circle" style="width: 100px; height: 100px; margin-left: 20px;">
                    <button type="button" class="btn" style="width: 130px; height: 42px; font-size: 13px; background-color: #B9FEB7; color: #1CB80E; margin-right: 150px">UPLOAD IMAGE</button>
                </div>
            </div>
        </div>
        <!-- Form Inputs -->
        <div class="mt-3" style="margin-left: 20px;">
            <form>
                <div class="mb-3 d-flex">
                    <div class="me-2" style="flex: 1;">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" style="width: 180px; height: 30px;">
                    </div>

                    <div style="flex: 1;">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" style="width: 180px; height: 30px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="country_code" class="form-label">Country Code</label>
                    <input type="number" class="form-control" id="country_code" name="country_code" style="width: 80px; height: 30px;">
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" style="width: 250px; height: 30px;">
                </div>

                <button type="submit" class="btn btn-primary">SAVE</button>
            </form>
        </div>
    </div>
@endsection