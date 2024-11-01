@extends('layouts.app')

@section('content')

@if (auth()->check() && auth()->user()->role != 'visitor')
<div class="row mb-2">
    <div class="col">
        <div class="d-flex justify-content-start">
            <form action="{{ route('pj.contents.create') }}" method="GET">
                <button type="submit" class="btn btn-sm btn-primary mt-2 me-2">
                    <i class="fa-regular fa-square-plus"></i>
                    Create Project
                </button>
            </form>
        </div>
    </div>
</div>
@endif

<table class="table caption-top">
    <caption>Tutorial by Project</caption>
    <thead class="text-nowrap">
        <tr>
            <th>#</th>
            <th>Project Titles</th>
            <th>Category</th>
            <th>Outline</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($projects->count() > 0)

        @foreach ($projects as $key => $pj)
        <tr>
            <td>{{ $key + 1}}</td>
            <td>{{ $pj->title }}</td>
            <td>
                @foreach ($pj->category_id as $cat)
                <span class="badge text-bg-primary rounded-pill">{{ $categories->where('id', $cat)->first()->category
                    }}</span>
                @endforeach
            </td>
            <td>{{ $pj->prologue }}</td>
            <td class="text-nowrap">
                <div class="d-flex justify-content-between">
                    @if ($pj->contents->count() > 0)
                    <form action="{{ route('pj.contents.show', $pj->id) }}" method="GET">

                        <button class="btn btn-sm btn-outline-primary rounded-pill py-0 mx-1"
                            type="submit">View</button>
                    </form>
                    @else

                    @guest
                    <img src="{{ asset('images/work-in-progress.png') }}" alt="Under construction" height="50">
                    @endguest

                    @endif

                    @auth
                    @if (auth()->user()->id === $pj->user_id)
                    <form action="{{ route('pj.titles.edit', $pj->id) }}" method="GET">
                        <button class="btn btn-sm btn-outline-success rounded-pill py-0" type="submit">Edit</button>
                    </form>
                    @else
                    Content belum tersedia
                    @endif
                    @endauth
                </div>
            </td>
        </tr>
        @endforeach

        @else
        <tr>
            <td colspan="5" class="text-center">No Project Data</td>
        </tr>
        @endif
    </tbody>
</table>

@push('scripts')

@endpush

@endsection