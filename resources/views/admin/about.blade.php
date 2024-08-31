@extends('layouts.app')

@section('content')
<div class="card">
    <div class="row g-0">
        <div class="col-md-2 p-2">
            <div class="row">
                <div class="col-12 text-center">
                    <img src="{{ asset('images/logo/user.png') }}" alt="admin" width="150">
                </div>
                <div class="col-12 px-4 mt-3 text-center">
                    <a href="https://www.facebook.com/arlenda.dimas" class="text-decoration-none text-dark"
                        target="_blank">
                        <i class="fa-brands fa-facebook"></i> Arlenda Dimas
                    </a>
                </div>
                <div class="col-12 px-4 text-center">
                    <a href="https://www.linkedin.com/in/arlenda-fitranto-b93925134"
                        class="text-decoration-none text-dark" target="_blank">
                        <i class="fa-brands fa-linkedin"></i> Arlenda Fitranto
                    </a>
                </div>
                <div class="col-12 px-4 text-center">
                    <a href="#" class="text-decoration-none text-dark" target="_blank">
                        <i class="fa-solid fa-globe"></i> RANZ - Coding
                    </a>
                </div>
            </div>

        </div>
        <div class="col-md-10">
            <div class="card-body">
                <h5 class="card-title">Arlenda Fitranto</h5>

                @if ($about && $about->count() > 0)
                <div>
                    {!! $about->contents !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection