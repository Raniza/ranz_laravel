<div class="alert bg-{{ $color }} {{ $color == 'success' ? 'text-black' : '' }} alert-dismissible fade
    show" role="alert">
    <strong class="{{ $color == 'success' ? 'text-black' : '' }}">{{ $color === 'danger' ? "Error" : "Success" }}:
    </strong>
    <span class="{{ $color == 'success' ? 'text-black' : '' }}">{{ $message }}</span>
    <button type="button" class="btn-close close" data-dismiss="alert" data-bs-dismiss="alert"
        aria-label="Close">&times;</button>
</div>