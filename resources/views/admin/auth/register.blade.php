@extends('layouts.app')

@section('content')
<div class="row mt-3">
    <div class="col-lg-5 col-md-10 m-auto">
        <div class="card ranz-border">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="text-center">
                            <img src="{{ asset('ranz2.png') }}" alt="ranz" width="26" class="align-middle"> <span
                                class="align-middle">REGISTER</span>
                        </h4>
                    </div>
                </div>
                <p class="text-center">
                    Silahkan register untuk memberikan komentar.
                </p>
                <hr>

                <form action="{{ route('user.register.action') }}" method="POST" id="registerForm">
                    @csrf
                    <div class="mb-3">
                        <label for="userName" class="form-label">Nama</label>
                        <input type="text" class="form-control el-disable @error('name') is-invalid @enderror"
                            id="userName" autofocus placeholder="Tulis nama lengkap anda..." name="name"
                            value="{{ old('name') }}">
                        @error('name')
                        <x-error.validation :$message />
                        @enderror
                    </div>
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
                            aria-describedby="passwordHelpBlock" placeholder="Masukan password anda..." name="password"
                            value="{{ old('password') }}">
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
                        <button type="submit" class="btn btn-sm btn-primary col-12 el-disable"><i
                                class="fa-solid fa-arrow-up-from-bracket"></i> Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const registerForm = document.getElementById('registerForm')

    registerForm.onsubmit = () => makeElementDisable()
</script>
@endpush
@endsection