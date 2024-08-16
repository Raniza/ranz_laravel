<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h1 class="modal-title fs-5" id="forgotPasswordModalLabel">Reset Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control el-disable" id="email" name="email"
                            placeholder="name@example.com">
                    </div>
                </div>
                <div class="modal-footer py-1">
                    <button type="button" class="btn btn-sm btn-secondary el-disable"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary el-disable"
                        onclick="makeElementDisable()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>