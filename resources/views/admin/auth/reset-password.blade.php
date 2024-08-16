@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-10 m-auto pt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4 class="text-center">
                                <img src="{{ asset('ranz2.png') }}" alt="ranz" width="26" class="align-middle"> <span
                                    class="align-middle">Reset Password</span>
                            </h4>
                        </div>
                    </div>

                    <hr>
                    <form action="{{ route('password.update') }}" method="POST" id="resetPasswordForm">
                        @csrf
                        <input type="hidden" value="{{ $token }}" name="token">

                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control el-disable @error('email') is-invalid @enderror"
                                id="userEmail" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                            @error('email')
                            <x-error.validation :$message />
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Password</label>
                            <input type="password" id="userPassword"
                                class="form-control el-disable @error('password') is-invalid @enderror"
                                aria-describedby="passwordHelpBlock" placeholder="Masukan password anda..."
                                name="password" value="{{ old('password') }}">
                            @error('password')
                            <x-error.validation :$message />
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmation Password</label>
                            <input type="password" id="confirmPassword"
                                class="form-control el-disable @error('password_confirmation') is-invalid @enderror"
                                aria-describedby="passwordHelpBlock" placeholder="Masukan kembali password anda..."
                                name="password_confirmation" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                            <x-error.validation :$message />
                            @enderror
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-sm btn-primary col-12 el-disable"
                                onclick="makeElementDisable()">
                                <i class="fa-solid fa-lock"></i> Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection