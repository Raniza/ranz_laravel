@extends('layouts.admin')

@section('content')

@if ($trashed_users->count() > 0)
<div class="row mb-2">
    <div class="col">
        <button class="btn btn-sm btn-primary" id="trashedUserBtn"><i class="fa-regular fa-trash-can"></i> Trashed
            Users</button>
    </div>
</div>
@endif

<div class="row">
    <div class="col">
        <table class="table table-striped table-sm" id="tableBodyExist">
            <caption>List of users</caption>
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Verified</th>
                    <th>Role</th>
                    <th>Join Date</th>
                    <th class="text-center">Change Role</th>
                </tr>
            </thead>
            <tbody>
                @if ($users->count() > 0)

                @foreach ($users as $key => $user)
                <tr>
                    <td class="text-center">{{ $key + 1}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        {!! $user->email_verified_at ? '<i class="fa-solid fa-circle-check text-success"></i>' : '<i
                            class="fa-solid fa-circle-xmark text-danger"></i>' !!}
                    </td>
                    <td>{{ ucwords($user->role )}}</td>
                    <td>{{ $user->created_at }}</td>
                    <td class="text-center">
                        @if (auth()->user()->id == $user->id)
                        -
                        @else
                        <div class="d-flex justify-content-center">

                            <button class="btn btn-sm btn-primary rounded-pill py-0 mx-2 el-disable" data-toggle="modal"
                                data-target="#userEditModal" onclick="setUserId({{ $user->id }})">
                                Edit
                            </button>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                id="submitDeleteForm{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill py-0 el-disable"
                                    onclick="confirmSubmit({{ $user->id }})">Delete</button>
                            </form>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach

                @else
                <tr class="text-center">
                    <td colspan="7">No users data</td>
                </tr>
                @endif
            </tbody>
        </table>

        @if ($trashed_users->count() > 0)
        <table class="table table-striped table-sm" id="tableBodyTrash" style="display: none">
            <caption>List of trashed users</caption>
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Verified</th>
                    <th>Role</th>
                    <th>Join Date</th>
                    <th>Deleted Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($trashed_users as $key_trashed => $trash_user)
                <tr>
                    <td class="text-center">{{ $key_trashed + 1}}</td>
                    <td>{{ $trash_user->name }}</td>
                    <td>{{ $trash_user->email }}</td>
                    <td class="text-center">
                        {!! $trash_user->email_verified_at ? '<i class="fa-solid fa-circle-check text-success"></i>' :
                        '<i class="fa-solid fa-circle-xmark text-danger"></i>' !!}
                    </td>
                    <td>{{ ucwords($trash_user->role )}}</td>
                    <td>{{ $trash_user->created_at }}</td>
                    <td>{{ $trash_user->deleted_at }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('users.destroy', $trash_user->id) }}?restore=1" method="POST">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-sm btn-primary rounded-pill py-0 mx-2 el-disable" type="submit"
                                    onclick="makeElementDisable()">
                                    Restore
                                </button>
                            </form>

                            <form action="{{ route('users.destroy', $trash_user->id) }}?force_delete=1" method="POST"
                                id="submitDeleteForm{{ $trash_user->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill py-0 el-disable"
                                    onclick="confirmSubmit({{ $trash_user->id }})">Force Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

@include('admin.partials.user-edit-modal')
@push('scripts')

@if ($trashed_users->count() > 0)
<script>
    const tableBodyExist = document.getElementById('tableBodyExist')
    const tableBodyTrash = document.getElementById('tableBodyTrash')
    const trashedUserBtn = document.getElementById('trashedUserBtn')
    
    trashedUserBtn.onclick = function() {
        if (tableBodyTrash.style.display == "none") {
            tableBodyExist.style.display = "none"
            tableBodyTrash.style.display = "table"
            this.innerHTML = '<i class="fa-regular fa-user"></i> Exist Users'
        } else {
            tableBodyExist.style.display = "table"
            tableBodyTrash.style.display = "none"
            this.innerHTML = '<i class="fa-regular fa-trash-can"></i> Trashed Users'
        }
        
    }
</script>
@endif

<script>
    const userId = document.getElementById('userId')

    $('#userEditModal').on('hidden.bs.modal', function (event) {
        userId.value = ""
    })

    function setUserId(id) {
        userId.value = id
    }

    function confirmSubmit(id) {
        if (confirm("Apakah Anda yakin ingin mengirim menghapus user ini?")) {
            makeElementDisable()
            document.getElementById(`submitDeleteForm${id}`).submit();
        } else {
            event.preventDefault()
            return false;
        }
    }
</script>

@endpush
@endsection