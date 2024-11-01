@extends('layouts.app')

@include('layouts.partials.head-summernote')

@section('content')

<div class="row">
    <div class="col-lg-9 col-md-12 m-auto">
        <form action="{{ route('pj.titles.update', $project->id) }}" method="POST" id="editPjTitleForm">
            @csrf
            @method("PUT")
            <div class="card card-body rounded-0">
                <div class="loading-overlay pj-title-form">
                    <div class="spinner"></div>
                </div>

                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="mb-3">
                            <label for="titleName" class="form-label">Title</label>
                            <input type="text"
                                class="form-control @error('title', 'projectErrors') is-invalid @enderror"
                                id="titleName" name="title" placeholder="Typed title here..."
                                value="{{ old('title', $project->title) }}">
                            @error('title', 'projectErrors')
                            <x-error.validation :$message />
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-7 col-sm-12">
                        <div class="mb-3">
                            <div class="card card-body mt-2">
                                <h5 class="card-title">Category</h5>
                                <div class="row px-2">
                                    @if ($categories->count() > 0)

                                    @foreach ($categories as $category)

                                    <div class="col-lg-3 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                                                id="category_{{ $category->id}}" name="category_id[]" {{
                                                in_array($category->id, old('category_id',
                                            $project->category_id ?? [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category_{{ $category->id}}">
                                                {{ $category->category }}
                                            </label>
                                        </div>
                                    </div>

                                    @endforeach


                                    @else
                                    <div class="col-12" style="margin-top: 35px;">
                                        <p class="text-danger fw-bolder">No Categories Data</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @error('category_id', 'projectErrors')
                            <x-error.validation :$message />
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="prologue" class="form-label">Prologue</label>
                    <textarea class="form-control @error('prologue', 'projectErrors') is-invalid @enderror"
                        id="prologue" rows="2" name="prologue">{{ old('prologue', $project->prologue) }}</textarea>
                    @error('prologue', 'projectErrors')
                    <x-error.validation :$message />
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <div class="col summer @error('desc', 'projectErrors') border border-danger @enderror">
                        <textarea id="desc" name="desc" class="bg-white"></textarea>
                    </div>
                    @error('desc', 'projectErrors')
                    <x-error.validation :$message />
                    @enderror
                </div>

                <div class="d-flex justify-content-end">

                    <x-forms.submit />
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const oldDesc = '{!! old('desc', $project->desc) !!}';
    const editPjTitleForm = document.getElementById('editPjTitleForm');

    editPjTitleForm.onsubmit = () => {
        loadingStatus('pj-title-form')
        removeErrorValidation()
    }
    
    $('#desc').summernote({
        callbacks: {
            onInit: function () {
                $('#desc').summernote("code", oldDesc);
            },
        }
    })
</script>
@endpush
@endsection