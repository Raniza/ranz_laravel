<div class="modal fade" id="addPjTitleModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="addPjTitleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="loading-overlay pj-title-modal">
                <div class="spinner"></div>
            </div>
            <div class="modal-header py-1">
                <h1 class="modal-title fs-5" id="addPjTitleModalLabel">Add Project Title</h1>
            </div>
            @if ($errors->projectErrors->any())
            @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    addPjTitleModal.show()
                })
            </script>
            @endpush
            @endif
            <form action="{{ route('pj.titles.store') }}" method="POST" id="addPjTitleForm">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5 col-md-12">
                            <div class="mb-3">
                                <label for="titleName" class="form-label">Title</label>
                                <input type="text"
                                    class="form-control @error('title', 'projectErrors') is-invalid @enderror"
                                    id="titleName" name="title" placeholder="Typed title here..."
                                    value="{{ old('title') }}">
                                @error('title', 'projectErrors')
                                <x-error.validation :$message />
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="mb-3">
                                <div class="card card-body mt-2">
                                    <h5 class="card-title">Category</h5>
                                    <div class="row px-2">
                                        @if ($categories->count() > 0)

                                        @foreach ($categories as $category)

                                        <div class="col-lg-3 col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $category->id }}" id="category_{{ $category->id}}"
                                                    name="category_id[]" {{ in_array($category->id, old('category_id',
                                                [])) ? 'checked' : '' }}>
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
                            id="prologue" rows="2" name="prologue">{{ old('prologue') }}</textarea>
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
                </div>

                <div class="modal-footer py-1">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <x-forms.submit />
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')

<script>
    const addPjTitleModal = new bootstrap.Modal('#addPjTitleModal')
    const modalAddPjTitle = document.getElementById('addPjTitleModal')
    const addPjTitleForm = document.getElementById('addPjTitleForm')

    let oldDesc = "{{ old('desc') }}";

    const resetModal = () => {
        const titleName = document.getElementById('titleName')
        const prologue = document.getElementById('prologue')
        const allCategories = document.querySelectorAll('input[type="checkbox"]')

        titleName.value = ""
        prologue.value = ""
        oldDesc = ""
        $('#desc').summernote('code', "")

        allCategories.forEach(cat => {
            cat.checked = false
        });

    }

    addPjTitleForm.onsubmit = () => {
        loadingStatus('pj-title-modal')
        removeErrorValidation()
    }

    modalAddPjTitle.addEventListener('hidden.bs.modal', () => {
        removeErrorValidation()
        resetModal()
        
    })
    
</script>

@if ($edit_mode)

{{-- Edit --}}
<script>

</script>

@else

{{-- Create New --}}
<script>
    $('#desc').summernote({
        callbacks: {
            onInit: function () {
                $('#desc').summernote("code", oldDesc);
            },
        }
    })
</script>

@endif

@endpush