<div class="modal fade" id="userEditModal" data-backdrop="static" tabindex="-1" aria-labelledby="userEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="userEditModalLabel">Change User Role</h5>
                <button type="button" class="close el-disable" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.update', 'update') }}" method="POST">
                @csrf
                @method("PUT")
                <input type="hidden" name="user_id" id="userId">
                <div class="modal-body">
                    <div class="input-group mb-2">
                        <select class="custom-select el-disable" id="roleSelect" name="role">
                            <option selected value="">Choose...</option>
                            <option value="admin">Admin</option>
                            <option value="editor">Editor</option>
                            <option value="visitor">Visitor</option>
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="roleSelect">Role</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-sm btn-secondary rounded-pill el-disable"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary rounded-pill el-disable"
                        onclick="makeElementDisable()">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>