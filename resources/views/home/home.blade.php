@extends('layouts.app')

@section('content')

@if (auth()->check() && auth()->user()->role == 'admin')
<form action="{{ route('home.edit', 'edit') }}" method="GET">
    <button class="btn btn-sm btn-primary mb-2" type="submit">
        Edit Home
    </button>
</form>
@endif

<h5>
    <span class="fw-bolder" style="color: #512DA8">RANZ</span> <img class="align-top" src="{{ asset('ranz2.png') }}"
        height="18" alt=""> -
    Home
</h5>

@if ($home)
<div class="mb-5">
    {!! $home->contents !!}
</div>
<div class="row">
    <img src="{{ asset('images/logo/php.png') }}" alt="php" class="col-lg-3 col-md-2 mb-5 m-auto">
    <img src="{{ asset('images/logo/laravel.png') }}" alt="laravel" class="col-lg-3 col-md-2 mb-5 m-auto">
    <img src="{{ asset('images/logo/javascripts.png') }}" alt="javascripts" class="col-lg-3 col-md-2 mb-5 m-auto">
    <img src="{{ asset('images/logo/jquery.png') }}" alt="jquery" class="col-lg-3 col-md-2 mb-5 m-auto">
    <img src="{{ asset('images/logo/react.png') }}" alt="react" class="col-lg-3 col-md-2 mb-5 m-auto">
    <img src="{{ asset('images/logo/nextjs.png') }}" alt="nexjs" class="col-lg-3 col-md-2 mb-5 m-auto">
</div>
@else
<p class="text-center py-5 fw-bolder text-danger">No Data</p>
@endif

@push('scripts')
{{-- <script>
    const home = {{ Js::from($home) }}

    console.log(home.contents);
</script> --}}
@endpush
@endsection