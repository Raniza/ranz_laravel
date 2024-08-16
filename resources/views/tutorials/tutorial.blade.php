@extends('layouts.app')

@section('content')
@if (auth()->check() && auth()->user()->role != 'visitor')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-start">
            <form action="{{ route('tutorials.all.create') }}" method="GET">
                <button type="submit" class="btn btn-sm btn-primary mt-2 me-2">
                    <i class="fa-regular fa-square-plus"></i>
                    Create Tutorial
                </button>
            </form>

            <form action="{{ route('tutorials.all.show', 1) }}" method="GET">
                <button class="btn btn-sm btn-success mt-2" type="submit">
                    <i class="fa-solid fa-bars-staggered"></i>
                    Tutorial List
                </button>
            </form>
        </div>
    </div>
</div>
@endif

@if ($titles->count() > 0)
@foreach ($titles as $stack => $categories)
<h3 class="mt-3">
    <img src="{{ asset('images/logo/' . $stack . '.png') }}" alt="{{ $stack }}" width="60">
    <span class="align-bottom">{{ strtoupper($stack) }}</span>
</h3>
<div class="row">

    @foreach ($categories as $title)
    <div class="col-md-12 col-lg-6">
        <h5>{{ $title->title }}</h5>
        <h6 class="mb-0 text-muted">
            Author:
            {{ $title->author->name }}
        </h6>
        <span class="text-muted" style="font-size: 14px;">
            {{ $title->updated_at }}
        </span>
        <p class="mt-2">
            {{ $title->prologue }}
        </p>
        <form action="{{ route('tutorials.title.show', $title->id) }}" method="GET">
            <button class="btn btn-sm btn-outline-primary" type="submit">
                Details
            </button>
        </form>
    </div>
    @endforeach
</div>
@endforeach
@endif

@push('scripts')
{{-- <script>
    const titles = {{ Js::from($titles) }}

    console.log(titles);
</script> --}}
@endpush
@endsection