<div class="modal fade" id="changePasswordModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h1 class="modal-title fs-5" id="changePasswordModalLabel">Change Password</h1>
            </div>

            @if ($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
            @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    changePasswordModal.show()
                })
            </script>
            @endpush
            @endif

            <form action="{{ route('user.change.password') }}" method="POST" id="changePassForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="oldPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control el-disable" id="oldPassword" name="current_password"
                            value="{{ old('current_password') }}">
                        @error('current_password')
                        <x-error.validation :$message />
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control el-disable" id="newPassword" name="password"
                            value="{{ old('password') }}">
                        @error('password')
                        <x-error.validation :$message />
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="confirmationPassword" class="form-label">Confirmation Password</label>
                        <input type="password" class="form-control el-disable" id="confirmationPassword"
                            name="password_confirmation" value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                        <x-error.validation :$message />
                        @enderror
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-sm btn-secondary el-disable"
                        data-bs-dismiss="modal">Close</button>
                    <x-forms.submit />
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const changePassForm = document.getElementById('changePassForm')
    const changePasswordModal = new bootstrap.Modal('#changePasswordModal')
    const modalChangePassword = document.getElementById('changePasswordModal')

    modalChangePassword.addEventListener('hidden.bs.modal', () => {
        removeErrorValidation()
    })
    
    changePassForm.onsubmit = () => {
        removeErrorValidation()
        makeElementDisable()
    }
</script>
@endpush