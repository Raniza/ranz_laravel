@extends('layouts.app')

@section('content')
<div class="row mt-5">
    <div class="col-lg-5 col-md-10 m-auto">
        <div class="card ranz-border">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="text-center">
                            <img src="{{ asset('ranz2.png') }}" alt="ranz" width="26" class="align-middle"> <span
                                class="align-middle">LOGIN</span>
                        </h4>
                    </div>
                </div>

                <p class="text-center">
                    Silahkan login untuk memulai sesi anda.
                </p>
                <hr>
                <form action="{{ route('user.auth') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control el-disable @error('email') is-invalid @enderror"
                            id="userEmail" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                        <div id="passwordHelpBlock" class="form-text">
                            Kami tidak akan pernah memberikan email anda kepada
                            siapapun.
                        </div>
                        @error('email')
                        <x-error.validation :$message />
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" id="userPassword"
                            class="form-control el-disable @error('password') is-invalid @enderror"
                            aria-describedby="passwordHelpBlock" placeholder="Masukan password anda..." name="password"
                            value="{{ old('password') }}">
                        @error('password')
                        <x-error.validation :$message />
                        @enderror

                    </div>
                    <hr>
                    <div class="mb-2">
                        <button type="submit" class="btn btn-sm btn-primary col-12 el-disable"
                            onclick="makeElementDisable()"><i class="fa-solid fa-arrow-right-to-bracket"></i> Sign
                            In</button>
                    </div>
                </form>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('user.register.form') }}" class="text-decoration-none"><i
                            class="fa-solid fa-arrow-up-from-bracket"></i> Register</a>

                    <a href="{{ route('home.index') }}" class="text-decoration-none"><i class="fa-solid fa-house"></i>
                        Home</a>
                </div>
                <a href="#" class="text-decoration-none text-dark" data-bs-toggle="modal"
                    data-bs-target="#forgotPasswordModal">
                    <i class="fa-solid fa-unlock"></i> Lupa Password?
                </a>
            </div>
        </div>
    </div>
</div>
@include('admin.auth.partials.forgot-password-modal')
@endsection