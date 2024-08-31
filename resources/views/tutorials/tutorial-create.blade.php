@extends('layouts.app')

@include('layouts.partials.head-summernote')

@section('content')
<form action="{{ route('tutorials.all.store') }}" method="POST" id="tutorialForm">
    <div class="loading-overlay tutorial-form">
        <div class="spinner"></div>
    </div>
    @csrf
    @if ($edit_mode)
    <input type="hidden" name="tutorial_id" value="{{ $tutorial->id }}">
    @endif
    <div class="d-flex justify-content-between">
        <h4>
            <span className="text-primary fw-bolder">
                {{ $edit_mode ? "Update" : "Create" }}
            </span> Tutorial
        </h4>
        <div>
            @if (! $edit_mode)
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#addTitleModal"><i class="fa-solid fa-circle-plus"></i> Add Title</button>
            @endif

            <x-forms.submit />
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <select class="form-select form-select-sm mb-2 @error('title_id') is-invalid @enderror"
                aria-label="Select tutorial title" name="title_id" id="selectTile">
                <option selected value="">Open to select title</option>

                @if ($titles->count() > 0)

                @foreach ($titles as $title)
                @php

                $selected = false;

                if ($edit_mode && ! old('title_id') && ! $errors->has('title_id')) {
                $selected = $title->id == $tutorial->title_id;
                }

                if (old('title_id')) {
                $selected = $title->id == old('title_id');
                }

                @endphp

                <option value="{{ $title->id }}" @selected($selected)>{{ $title->title }}</option>

                @endforeach
                @endif
            </select>
            @error('title_id')
            <x-error.validation :$message />
            @enderror
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="input-group input-group-sm mb-2">

                @php
                $sub_title_value = "";

                if (old('sub_title')) {
                $sub_title_value = old('sub_title');
                } else {

                if ($edit_mode && ! $errors->has('sub_title')) {
                $sub_title_value = $tutorial->sub_title;
                }

                }

                @endphp

                <span class="input-group-text" id="title-addon">Sub Title</span>
                <input type="text" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Sub title"
                    aria-label="Sub title" aria-describedby="title-addon" name="sub_title"
                    value="{{ $sub_title_value }}">

            </div>
            @error('sub_title')
            <x-error.validation :$message />
            @enderror
        </div>

        <div class="col-sm-12 col-lg-4">
            <p class="d-flex justify-content-end mb-2">
                Category:&nbsp;&nbsp; <span class="fw-bolder text-danger" id="spanCategory">{{ $edit_mode ?
                    $tutorial->title->category->category : '---' }}</span>
            </p>
            @push('scripts')
            <script>
                const spanCategory = document.getElementById('spanCategory')
                const selectTile = document.getElementById('selectTile')

                const titles = {{ Js::from($titles) }}
                const categories = {{ Js::from($categories) }}

                selectTile.onchange = function() {
                    const titleId = this.value

                    if (titleId > 0) {
                        const selectedTitleCategory = titles.filter(row => row.id == titleId)[0].category_id
                        const categoryTitle = categories.filter(row => row.id == selectedTitleCategory)[0].category

                        spanCategory.innerHTML = capitalize(categoryTitle)
                    } else {
                        spanCategory.innerHTML = "---"
                    }
                }
            
            </script>
            @endpush
        </div>
    </div>
    <div class="row mt-2">
        @error('contents')
        <x-error.validation :$message />
        @enderror
        <div class="col mb-3">
            <div class="col summer @error('contents') border border-danger @enderror">
                <textarea id="contents" name="contents" class="bg-white"></textarea>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <x-forms.submit />
            </div>
        </div>
    </div>
</form>

@include('tutorials.partials.title-add-modal')

@push('scripts')

@if (old('contents'))
<script>
    const tutorContents = "{!! old('contents') !!}"

    $('#contents').summernote({
        callbacks: {
            onInit: function () {
                $('#contents').summernote("code", tutorContents);
            },
        }
    })
</script>
@else

@if ($edit_mode)
{{-- Edit mode --}}
<script>
    const tutorial = @json($tutorial)

    $('#contents').summernote({
        callbacks: {
            onInit: function () {
                $('#contents').summernote("code", tutorial.contents);
            },
        }
    })
</script>

@else
{{-- Create new mode --}}

<script>
    $('#contents').summernote({
        callbacks: {
            onInit: function () {
                $('#contents').summernote("code", "");
            },
        }
    })
</script>

@endif

@endif

<script>
    const tutorialForm = document.getElementById('tutorialForm')

    tutorialForm.onsubmit = () => {
        removeErrorValidation()
        loadingStatus('tutorial-form')
    }

</script>

@endpush

@endsection