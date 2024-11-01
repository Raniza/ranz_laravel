@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-12 m-auto">
            <div class="card border-0">
                <div class="card-body py-2">
                    <h5 class="card-title">

                        @foreach ($project->category_id as $cat)

                        <?php
                        $selCat = $categories->where('id', $cat)->first()->category;
                       
                        ?>

                        <img src="{{ asset('images/logo/' . $selCat . '.png') }}" height="32" alt="{{ $selCat }}">

                        @endforeach

                        <span class="align-middle">
                            {{ $project->title }}
                        </span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Author: {{ $project->author->name }}
                    </h6>
                    <hr>
                    <p class="card-text" style="text-align: justify;">
                        {{ $project->prologue }} <br>
                        <a href="#collapsedesc" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="collapsedesc" class="text-decoration-none">
                            Click untuk mengetahui yang akan dipelajari <i class="fa-regular fa-folder-open"></i>
                        </a>
                    </p>
                    <div class="collapse" id="collapsedesc">
                        <div class="card card-body">
                            {!! $project->desc !!}
                        </div>
                    </div>

                    <div class="accordion mb-3 mt-2">
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

                                            @if ($project->contents->count() > 0)

                                            @foreach ($project->contents as $key => $content)


                                            <form action="{{ route('pj.contents.edit', $project->id) }}" method="GET"
                                                id="editContent{{ $content->id }}">
                                                <input type="hidden" name="project_content_id"
                                                    value="{{ $content->id }}">
                                            </form>

                                            @if ($content->is_publish)
                                            <li class="list-group-item" style="cursor: pointer;">
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('pj.contents.show', $project->id) .'?project_content_id=' . $content->id }}"
                                                        class="text-decoration-none {{ $content->id == $project_content->id ? 'text-primary' : 'text-dark' }}">{{
                                                        '#' . $key + 1 . " " .
                                                        $content->sub_title }}
                                                    </a>

                                                    @auth
                                                    @if (auth()->user()->id == $project->user_id)

                                                    <span>
                                                        <i class="fa-solid fa-circle-check text-primary mx-1"></i>
                                                        <button
                                                            class="btn btn-sm btn-success py-0 rounded-pill btn-edit"
                                                            type="button" edit-content-id={{ $content->id }}>
                                                            Edit
                                                        </button>
                                                    </span>

                                                    @endif
                                                    @endauth
                                                </div>
                                            </li>
                                            @else

                                            @auth
                                            @if (auth()->user()->id == $project->user_id)

                                            <li class="list-group-item" style="cursor: pointer;">
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('pj.contents.show', $project->id) .'?project_content_id=' . $content->id }}"
                                                        class="text-decoration-none {{ $content->id == $project_content->id ? 'text-primary' : 'text-dark' }}">{{
                                                        '#' . $key + 1 . " " .
                                                        $content->sub_title }}
                                                    </a>
                                                    <span>
                                                        <form action="{{ route('pj.contents.publish', $content->id) }}"
                                                            method="POST" id="publishContent{{ $content->id }}">
                                                            @csrf
                                                        </form>

                                                        <button
                                                            class="btn btn-sm btn-warning py-0 rounded-pill mx-1 btn-publish"
                                                            type="button" data-content-id={{ $content->id }}>
                                                            Publish
                                                        </button>

                                                        <button
                                                            class="btn btn-sm btn-success py-0 rounded-pill btn-edit"
                                                            type="button" edit-content-id={{ $content->id }}>
                                                            Edit
                                                        </button>
                                                    </span>
                                                </div>
                                            </li>

                                            @endif
                                            @endauth

                                            @endif

                                            @endforeach

                                            @if (! $project->contents->where('is_publish', true)->count() > 0)
                                            @if ((auth()->check() && auth()->user()->id != $project->user_id) || !
                                            auth()->check())
                                            <li class="list-group-item">Tidak ada tutorials</li>
                                            @endif
                                            @endif

                                            @else
                                            <li class="list-group-item">Tidak ada tutorials</li>
                                            @endif

                                            @push('scripts')
                                            <script>
                                                const btnPublish = document.querySelectorAll('.btn-publish')
                                                const btnEdit = document.querySelectorAll('.btn-edit')
                                                // console.log(btnEdit);

                                                btnPublish.forEach(btn => {
                                                    btn.onclick = (e) => {
                                                        const contentId = e.target.getAttribute('data-content-id')
                                                        const submitForm = document.getElementById(`publishContent${contentId}`)

                                                        submitForm.submit()
                                                    }
                                                });

                                                btnEdit.forEach(btn => {
                                                    btn.onclick = (e) => {
                                                        const contentId = e.target.getAttribute('edit-content-id')
                                                        const submitForm = document.getElementById(`editContent${contentId}`)
                                                        // console.log(contentId);
                                                        submitForm.submit()
                                                    }
                                                });
                                            </script>
                                            @endpush
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($project_content && $project_content->count() > 0)

                    @if ($project_content->is_publish)
                    {{-- Guest --}}
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span class="text-decoration-underline">
                            {{ $project_content->sub_title }}
                        </span>
                        <br>
                        <span class="text-muted" style="font-size: 14px;">
                            {{ $project_content->updated_at }}
                        </span>
                    </h6>
                    <div style="text-align: justify;">
                        {!! $project_content->contents !!}
                    </div>

                    @else

                    @auth
                    @if (auth()->user()->id == $project->user_id)
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span class="text-decoration-underline">
                            {{ $project_content->sub_title }}
                        </span>
                        <br>
                        <span class="text-muted" style="font-size: 14px;">
                            {{ $project_content->updated_at }}
                        </span>
                    </h6>
                    <div style="text-align: justify;">
                        {!! $project_content->contents !!}
                    </div>
                    @endif
                    @endauth

                    @endif


                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-12 m-auto">
            <div class="card mt-3">
                <div class="card-body py-2">
                    <h5>Comment</h5>
                    <hr>
                    <p class="align-middle">
                        Kebijakan komentar dalam <img class="align-middle" src="{{ asset('ranz2.png') }}" alt="Ranz"
                            height="20"> <span class="fw-bolder align-baseline" style="color: #512DA8;">RANZ</span>
                        bersifat
                        moderasi. SIlahkan tinggalkan komentar dengan lugas dan sopan. Admin akan menampilkan komentar
                        anda.
                    </p>
                    <hr>

                    @if ($project_content && $project_content->comments->count() > 0)
                    @foreach ($project_content->comments as $comment)
                    <p>
                        {{ $comment->user->name }} <span class="text-muted" style="font-size: 14px;">{{
                            $comment->updated_at
                            }}</span>
                    </p>
                    <p>{{ $comment->comment }}</p>
                    <hr>
                    @endforeach
                    @endif

                    @auth
                    @if ($project_content)
                    <form action="{{ route('pj.comment.store') }}" method="POST" id="commentForm">
                        @csrf

                        <input type="hidden" value="{{ $project_content->id }}" name="project_content_id">
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
                    @endif
                    @endauth

                    @guest
                    <form action="{{ route('login') }}" method="GET">
                        <button type="submit" class="btn btn-sm btn-primary">Login to Leave Comment</button>
                    </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

@endpush

@endsection