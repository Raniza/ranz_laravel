<div class="modal fade" id="successAlertModal" tabindex="-1" aria-labelledby="successAlertModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-success-subtle">
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
    const successAlertModal = new bootstrap.Modal('#successAlertModal')

    successAlertModal.show()
</script>

@endpush