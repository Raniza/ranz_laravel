<div class="modal fade" id="addTitleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addTitleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="loading-overlay title-status">
                <div class="spinner"></div>
            </div>
            <div class="modal-header py-1">
                <h1 class="modal-title fs-5" id="addTitleModalLabel">Add title</h1>
            </div>
            @if ($errors->has('title_name') || $errors->has('category_id') || $errors->has('prologue'))
            @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    addTitleModal.show()
                })
            </script>
            @endpush
            @endif
            <form action="{{ route('tutorials.title.store') }}" method="POST" id="addTitleForm">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="titleName" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title_name') is-invalid @enderror" id="titleName"
                            name="title_name" placeholder="Typed title here...">
                        @error('title_name')
                        <x-error.validation :$message />
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Title</label>
                        <select class="form-select @error('category_id') is-invalid @enderror"
                            aria-label="Category select" id="category" name="category_id">
                            <option selected value="">Open to select category</option>
                            @if ($categories->count() > 0)
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ ucwords($category->category) }}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('category_id')
                        <x-error.validation :$message />
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prologue" class="form-label">Prologue</label>
                        <textarea class="form-control @error('prologue') is-invalid @enderror" id="prologue"
                            name="prologue" rows="3"></textarea>
                        @error('prologue')
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
    const addTitleModal = new bootstrap.Modal('#addTitleModal')
    const modalAddTitle = document.getElementById('addTitleModal')
    const addTitleForm = document.getElementById('addTitleForm')

    addTitleForm.onsubmit = () => {
        loadingStatus('title-status')
    }

    modalAddTitle.addEventListener('hidden.bs.modal', () => {
        removeErrorValidation()
    })
</script>

@endpush