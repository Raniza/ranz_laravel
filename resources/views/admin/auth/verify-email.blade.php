@extends('layouts.app')

@section('content')
<div class="card col-lg-10 col-md-12 m-auto mt5">
    <div class="card-body">
        <h5 class="card-title">Verifikasi email anda</h5>
        <p class="card-text">
            Sebelum melanjutkan proses ini, silahkan check email
            anda untuk verifikasi link. Jika anda tidak mendapatkan
            email.
        </p>
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button class="btn btn-sm btn-primary" type="submit">
                Click untuk mengirimkan kembali link verifikasi email
            </button>
        </form>
    </div>
</div>
@endsection