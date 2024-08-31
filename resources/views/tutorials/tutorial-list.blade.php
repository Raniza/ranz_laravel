@extends('layouts.app')

@section('content')
<div class="card ranz-border">
    <div class="card-header">
        Tutorial List
    </div>
    <div class="card-body">
        <div class="loading-overlay tutorial-list-overlay">
            <div class="spinner"></div>
        </div>
        <table class="table list-table">
            <thead>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Final</th>
                <th>Author</th>
                <th>Subtitle</th>
                <th class="text-center">Publish</th>
                <th class="text-center">Action</th>
            </thead>
            <tbody>
                @if ($titles->count() > 0)
                @foreach ($titles as $key => $title)
                @php
                $row_span = $title->tutorials->count() + 1;
                @endphp
                <tr>
                    <td rowspan="{{ $row_span }}">{{ $key + 1 }}</td>
                    <td rowspan="{{ $row_span }}">{{ $title->title }}</td>
                    <td rowspan="{{ $row_span }}">{{ $title->category->category }}</td>
                    <td rowspan="{{ $row_span }}">{{ $title->is_final ? "Final" : "Progress"}}</td>
                    <td rowspan="{{ $row_span }}">{{ $title->author->name }}</td>
                    @if ($title->tutorials->count())
                    @foreach ($title->tutorials as $tutorial)
                <tr>
                    <td>{{ $tutorial->sub_title }}</td>
                    <td class="text-center">
                        @if ($tutorial->is_publish)
                        <span class="badge text-bg-primary rounded-pill">Yes</span>
                        @else
                        <span class="badge text-bg-warning rounded-pill">No</span>
                        @endif
                    </td>
                    <td class="text-center text-nowrap">
                        @if (! $tutorial->is_publish)
                        <form action="{{ route('tutorials.all.update', $tutorial->id) }}" method="POST"
                            id="tutorPublish{{ $tutorial->id }}" class="tutor-form">
                            @csrf
                            @method("PUT")
                        </form>

                        <button class="btn btn-sm btn-primary py-0 rounded-pill" type="button"
                            onclick="publishTutorial({{ $tutorial->id }})">
                            Publish
                        </button>
                        @endif
                        <button class="btn btn-sm btn-success py-0 rounded-pill">
                            <a class="text-decoration-none text-white"
                                href="{{ route('tutorials.all.edit', $tutorial->id) }}">
                                Edit
                            </a>
                        </button>
                        <button class="btn btn-sm btn-info py-0 rounded-pill">
                            <a class="text-decoration-none text-dark"
                                href="{{ route('tutorials.title.show', $title->id) }}?tutorial_id={{ $tutorial->id }}">
                                Show
                            </a>
                        </button>
                    </td>
                </tr>
                @endforeach
                {{-- @else
                <td>Tidak ada tutorial</td> --}}
                @endif
                </tr>
                @endforeach
                @else

                @endif
            </tbody>
        </table>
        {{ $titles->links() }}
    </div>
</div>

@push('scripts')

<script>
    const publishTutorial = (id) => {
        document.getElementById(`tutorPublish${id}`).submit();
        document.querySelector('.tutorial-list-overlay').style.display = 'flex'
    }
</script>
@endpush
@endsection