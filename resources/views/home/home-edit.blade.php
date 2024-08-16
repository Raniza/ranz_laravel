@extends('layouts.app')

@include('layouts.partials.head-summernote')

@section('content')

<div class="card">
    <form action="{{ route('home.update', 'update') }}" method="POST">
        @csrf
        @method("PUT")
        <div class="card-header fw-bolder text-primary">
            <div class="d-flex justify-content-between">
                <span class="pt-1">Edit Home</span>
                <x-forms.submit />
            </div>
        </div>
        <div class="card-body">
            @error('contents')
            <div class="alert bg-danger text-white alert-dismissible fade show mb-2" role="alert">
                <strong>Validation Error!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror

            @if (session('error_contents'))
            <div class="alert bg-danger text-white alert-dismissible fade show mb-2" role="alert">
                <strong>Error!</strong> {{ session('error_contents') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row mb-2">
                <div class="col">
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
</div>

@push('scripts')
<script>
    const home = @json($home);

    if (home) {
        $('#contents').summernote("code", home.contents)
    } else {
        $('#contents').summernote({
            placeholder: "Tulis home web disini.",
            callbacks: {
                onInit: function () {
                    $('#contents').summernote("code", "");
                },
            }
        })
    }

    $('#contents').summernote({
        toolbar: [
            ['paragraph', ['style', 'ol', 'ul', 'paragraph']],
            ['font', ['fontname', 'fontsize', 'strikethrough', 'superscript']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['insert', ['table', 'picture', 'link']],
            ['misc', ['fullscreen', 'codeview', 'undo', 'redo']]
        ]
    })
    
</script>
@endpush

@endsection