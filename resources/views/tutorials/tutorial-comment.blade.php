@extends('layouts.admin')

@section('content')

@if ($comments->count() > 0)

@php
$n_comment = 0;
@endphp

@foreach ($comments as $sub_comments)

@php
$n_comment =+ 1;
@endphp

<h6 class="mt-2">
    Tutorial: #{{ $n_comment . " " . $sub_comments->first()->tutorial->title->title }}
</h6>
<p>
    Author:
    <span class="text-muted" style="font-size: 14px;">
        {{ $sub_comments->first()->tutorial->title->author->name }}
    </span>
    <br>
    {{ $sub_comments->first()->tutorial->title->prologue }}
</p>

<strong>Comment: </strong>
<br>

{{-- Comment --}}
@foreach ($sub_comments as $key => $comment)
<blockquote class="mt-2">
    #{{ $key + 1 }}
    <br>
    <strong>Sub Title:</strong> {{ $comment->tutorial->sub_title }}
    <br>
    {{ $comment->comment }}
    <br>
    <span class="text-muted" style="font-size: 14px;">
        Comment by: {{ $comment->user->name }}
    </span>
    <br>
    <form action="{{ route('tutorials.comment.update', $comment->id) }}" method="POST" class="comment-form">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-start align-bottom">
            <input type="submit" class="btn btn-sm btn-primary mt-2 mx-2 el-disable" value="Approve" name="approve">
            <input type="submit" class="btn btn-sm btn-danger mt-2 mx-2 el-disable" value="Reject" name="reject">
            <input type="text" name="reason" id="rejectReason" class="form-control form-control-sm mt-2 mx-2 el-disable"
                placeholder="Type reason for reject...">

        </div>
    </form>
</blockquote>
@endforeach
{{-- Comment --}}

@endforeach
<hr>
{{-- Project Comments --}}

@if ($project_comments->count() > 0)

<?php
$n_pj_comment = 0;
?>

@foreach ($project_comments as $sub_pj_comments)

<?php
$n_pj_comment =+ 1;
?>

<h6 class="mt-2">
    Project: #{{ $n_pj_comment . " " . $sub_pj_comments->first()->content->project->title }}
</h6>
<p>
    Author:
    <span class="text-muted" style="font-size: 14px;">
        {{ $sub_pj_comments->first()->content->project->author->name }}
    </span>
    <br>
    {{ $sub_pj_comments->first()->content->project->prologue }}
</p>

<strong>Comment: </strong>
<br>

{{-- Comment --}}

@foreach ($sub_pj_comments as $key => $comment)
<blockquote class="mt-2">
    #{{ $key + 1 }}
    <br>
    <b>Sub Title</b> {{ $comment->content->sub_title }}
    <br>
    {{ $comment->comment }}
    <br>
    <span class="text-muted" style="font-size: 14px;">
        Comment by: {{ $comment->user->name }}
    </span>
    <br>

    <form action="{{ route('pj.comment.update', $comment->id) }}" method="POST" class="comment-form">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-start align-bottom">
            <input type="submit" class="btn btn-sm btn-primary mt-2 mx-2 el-disable" value="Approve" name="approve">
            <input type="submit" class="btn btn-sm btn-danger mt-2 mx-2 el-disable" value="Reject" name="reject">
            <input type="text" name="reason" id="rejectReason" class="form-control form-control-sm mt-2 mx-2 el-disable"
                placeholder="Type reason for reject...">

        </div>
    </form>
</blockquote>
@endforeach

{{-- Comment --}}

@endforeach

@endif

{{-- Project Comments --}}

@else
<blockquote className="mt-2">
    Tidak ada data comment.
</blockquote>
@endif

@push('scripts')
<script>
    const submitCommentForm = document.querySelectorAll('.comment-form')

    submitCommentForm.forEach(submitForm => {
        submitForm.addEventListener('submit', () => {
            makeElementDisable()
        })
    });
    
</script>
@endpush
@endsection