<div class="modal fade" id="errorAlertModal" tabindex="-1" aria-labelledby="errorAlertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-danger-subtle">
            <div class="modal-body">
                {{ $message }}
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>
    const errorAlertModal = new bootstrap.Modal('#errorAlertModal')

    errorAlertModal.show()
</script>

@endpush