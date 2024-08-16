@extends('layouts.app')

@section('content')
<div class="card ranz-border">
    <div class="card-header">
        Tutorial List
    </div>
    <div class="card-body">
        <table class="table list-table">
            <thead>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Final</th>
                <th>Subtitle</th>
                <th>Author</th>
                <th>Publish</th>
                <th>Action</th>
            </thead>
            <tbody>
                @if ($titles->count() > 0)
                @foreach ($titles as $key => $title)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $title->title }}</td>
                    <td>{{ $title->category->category }}</td>
                    <td>{{ $title->is_final ? "Final" : "Progress"}}</td>
                </tr>
                @endforeach
                @else

                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection