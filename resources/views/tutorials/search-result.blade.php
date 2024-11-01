@extends('layouts.app')

@section('content')
@if ($titles->count() > 0)

<h5 class="fw-normal">Search result by <b>"Title"</b></h5>
<hr>

<div class="row">
    @foreach ($titles as $title)


    <div class="col-md-12 col-lg-6">
        <h3 class="mt-3">
            <img src="{{ asset('images/logo/' . strtolower($title->category->category) . '.png') }}"
                alt="{{ $title->category->category }}" width="60">
            <span class="align-bottom">{{ strtoupper($title->category->category) }}</span>
        </h3>
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

@endif

@if ($tutorials->count() > 0)

<h5 class="fw-normal mt-4">Search result by <b>"Subtitle and Tutorial contents"</b></h5>
<hr>

<div class="row">
    @foreach ($tutorials as $tutorial)


    <div class="col-md-12 col-lg-6">
        <h3 class="mt-3">
            <img src="{{ asset('images/logo/' . strtolower($tutorial->title->category->category) . '.png') }}"
                alt="{{ $tutorial->title->category->category }}" width="60">
            <span class="align-bottom">{{ strtoupper($tutorial->title->category->category) }}</span>
        </h3>
        <h6 class="mb-0 text-muted">
            Author:
            {{ $tutorial->title->author->name }}
        </h6>
        <h5>{{ $tutorial->title->title }}</h5>
        <p>
            Sub Title: {{ $tutorial->sub_title}}
        </p>
        <span class="text-muted" style="font-size: 14px;">
            {{ $tutorial->title->updated_at }}
        </span>
        <p class="mt-2">
            {{ $tutorial->title->prologue }}
        </p>
        <form action="{{ route('tutorials.title.show', $tutorial->title_id) }}" method="GET">
            <input type="hidden" name="tutorial_id" value="{{ $tutorial->id }}">
            <button class="btn btn-sm btn-outline-primary" type="submit">
                Details
            </button>
        </form>
    </div>

    @endforeach
</div>

@endif

@if (!$titles->count() > 0 && $tutorials->count() > 0)

<h5 class="fw-normal mt-4">Search result <b>"No tutorial"</b></h5>
<hr>

@endif

@endsection