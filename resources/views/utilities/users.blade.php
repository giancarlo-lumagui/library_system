@extends('layouts.default')

@section('aside')
    @include('layouts.sidebar')
@endsection

@section('main')
    <div class="btns p-2 d-flex justify-content-end">
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <bi class="bi bi-plus"></bi>
            Add user
        </button>
    </div>
    <div class="container-fluid p-2 d-flex justify-content-end">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>
    </div>

    <!-- modal for adding users -->

    <div class="modal fade" id="addUserModal" aria-labelledby="addUserModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add user</h4>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <bi class="bi bi-person"></bi>
                            </span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter name..." required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <bi class="bi bi-key"></bi>
                            </span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password..." required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <bi class="bi bi-person-badge"></bi>
                            </span>
                            <select class="form-control" name="role" id="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-outline-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection