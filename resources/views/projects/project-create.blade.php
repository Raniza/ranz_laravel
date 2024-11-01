@extends('layouts.app')

@include('layouts.partials.head-summernote')

@section('content')

<div class="loading-overlay pj-contents">
    <div class="spinner"></div>
</div>

<?php
if ($edit_mode) {
    $url = route('pj.contents.update', $project_content->id);
} else {
    $url = route('pj.contents.store');
}
?>
<form action="{{ $url }}" method="POST" id="projecContentstForm">
    <div class="row">
        <div class="col-12">
            <div class="loading-overlay project-form">
                <div class="spinner"></div>
            </div>
            @csrf

            @if ($edit_mode)
            @method("PUT")
            {{-- <input type="hidden" name="project_id" value="{{ $project_content->project_id }}"> --}}
            @endif

            <div class="d-flex justify-content-between">
                <h4>
                    <span className="text-primary fw-bolder">
                        {{ $edit_mode ? "Update" : "Create" }}
                    </span> Project
                </h4>

                <div>
                    @if (! $edit_mode)
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addPjTitleModal"><i class="fa-solid fa-circle-plus"></i> Add Project
                        Title</button>
                    @endif

                    <x-forms.submit />
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-5">
                    <select
                        class="form-select form-select-sm mb-2 @error('project_id', 'pjContentsErrors') is-invalid @enderror"
                        aria-label="Select tutorial title" name="project_id" id="selectTitle">
                        <option selected value="">Open to select title</option>
                        @if ($projects->count() > 0)

                        @foreach ($projects as $pj)
                        <option value="{{ $pj->id }}" @selected($edit_mode && $project_content->project_id ==
                            $pj->id)>{{
                            $pj->title }}</option>
                        @endforeach

                        @endif
                    </select>
                    @error('project_id', 'pjContentsErrors')
                    <x-error.validation :$message />
                    @enderror
                </div>
                <div class="col-sm-12 col-lg-7">
                    <div class="input-group input-group-sm mb-2">
                        <span class="input-group-text">Sub Title</span>
                        <input type="text"
                            class="form-control @error('sub_title', 'pjContentsErrors') is-invalid @enderror"
                            placeholder="Sub title" aria-label="Sub title" name="sub_title"
                            value="{{ old('sub_title', $edit_mode ? $project_content->sub_title : '') }}">
                    </div>
                    @error('sub_title', 'pjContentsErrors')
                    <x-error.validation :$message />
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col mb-3">
                    <div class="col summer @error('contents', 'pjContentsErrors') border border-danger @enderror">
                        <textarea id="contents" name="contents" class="bg-white"></textarea>
                    </div>
                </div>
                @error('contents', 'pjContentsErrors')
                <x-error.validation :$message />
                @enderror

                <div class="row mb-2">
                    <div class="col">
                        <x-forms.submit />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@include('projects.modals.project-title-modal')

@push('scripts')

<script>
    const oldContents = "{!! old('contents', $edit_mode ? $project_content->contents : '') !!}";
    const projecContentstForm = document.getElementById('projecContentstForm');
    

    projecContentstForm.onsubmit = () => {
        loadingStatus('pj-contents')
        removeErrorValidation()
    }

    $('#contents').summernote({
        callbacks: {
            onInit: function () {
                $('#contents').summernote("code", oldContents);
            },
        }
    })
</script>

@if ($edit_mode)

{{-- Edit Mode --}}

@else

{{-- Create New --}}
<script>

</script>

@endif

@endpush

@endsection