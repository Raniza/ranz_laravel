@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-9 col-sm-12 mb-3">
        <div class="card border-0">
            <div class="card-body py-2">
                <h5 class="card-title">
                    <img src="{{ asset('images/logo/' . $title->category->category . '.png') }}" height="26"
                        alt="{{ $title->category->category }}">
                    <span class="align-middle">
                        {{ $title->title }}
                    </span>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    Author: {{ $title->author->name }}
                </h6>
                <hr>
                <p class="card-text" style="text-align: justify;">
                    {{ $title->prologue }}
                </p>

                <div class="accordion mb-3">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#tutorialContents" aria-expanded="true"
                                aria-controls="tutorialContents">
                                Contents
                            </button>
                        </h2>
                        <div id="tutorialContents" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="mb-2">
                                    <ul class="list-group">
                                        @if ($title->tutorials->count() > 0)
                                        @foreach ($title->tutorials as $key => $tutor)
                                        <li class="list-group-item {{ $tutor->id == $tutorial->id ? 'text-primary' : '' }}"
                                            style="cursor: pointer;">
                                            <a href="{{ route('tutorials.title.show', $title->id) . 
                                            " ?tutorial_id=" . $tutor->id }}"
                                                class="text-decoration-none {{ $tutor->id != $tutorial->id ? 'text-dark' : '' }}">{{
                                                '#' . $key + 1 . " " .
                                                $tutor->sub_title }}
                                            </a>
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="list-group-item">Tidak ada tutorials</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($tutorial)
                <h6 class="card-subtitle mb-2 text-muted">
                    <span class="text-decoration-underline">
                        {{ $tutorial->sub_title }}
                    </span>
                    <br>
                    <span class="text-muted" style="font-size: 14px;">
                        {{ $tutorial->updated_at }}
                    </span>
                </h6>
                <div style="text-align: justify;">
                    {!! $tutorial->contents !!}
                </div>
                @endif
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body py-2">
                <h5>Comment</h5>
                <hr>
                <p class="align-middle">
                    Kebijakan komentar dalam <img class="align-middle" src="{{ asset('ranz2.png') }}" alt="Ranz"
                        height="20"> <span class="fw-bolder align-baseline" style="color: #512DA8;">RANZ</span> bersifat
                    moderasi. SIlahkan tinggalkan komentar dengan lugas dan sopan. Admin akan menampilkan komentar anda.
                </p>
                <hr>
                @if ($tutorial->comments->count() > 0)
                @foreach ($tutorial->comments as $comment)
                <p>
                    {{ $comment->user->name }} <span class="text-muted" style="font-size: 14px;">{{ $comment->updated_at
                        }}</span>
                </p>
                <p>{{ $comment->comment }}</p>
                <hr>
                @endforeach
                @endif

                @auth
                <form action="{{ route('tutorials.comment.store') }}" method="POST" id="commentForm">
                    @csrf
                    <input type="hidden" value="{{ $title->id }}" name="title_id">
                    <input type="hidden" value="{{ $tutorial->id }}" name="tutorial_id">
                    <div class="mb-3">
                        <label for="comment" class="form-lable mb-2">Leave Comment</label>
                        <textarea class="form-control border-2 el-disable @error('comment') is-invalid @enderror"
                            name="comment" id="comment" rows="2"></textarea>
                        @error('comment')
                        <x-error.validation :$message />
                        @push('scripts')
                        <script>
                            window.addEventListener('load', function () {
                                window.scrollTo(0, document.body.scrollHeight);
                            });
                        </script>
                        @endpush
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-primary el-disable">Submit</button>
                </form>
                @endauth

                @guest
                <form action="{{ route('user.login') }}" method="GET">
                    <button type="submit" class="btn btn-sm btn-primary">Login to Leave Comment</button>
                </form>
                @endguest
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-12">
        <div class="card border-0">
            <div class="card-body py-3">
                <h6 class="card-subtitle mb-0">
                    Related Contents:
                </h6>
                <ul class="list-group list-group-flush">
                    @if ($title_category->count() > 0)
                    @foreach ($title_category as $title_by)
                    <li class="list-group-item">
                        <a href="{{ route('tutorials.title.show', $title_by->id) }}"
                            class="text-decoration-none text-dark">
                            {{ $title_by->title }}
                        </a>
                    </li>
                    @endforeach
                    @else
                    <li class="list-group-item">No related contents</li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    const commentForm = document.getElementById('commentForm')

    commentForm.onsubmit = () => {
        makeElementDisable()
        removeErrorValidation()
    }

</script>
@endpush
@endsection