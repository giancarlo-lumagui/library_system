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
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userList">
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
                    <form id="formData" action="#">
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
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for editing users -->

    <div class="modal fade" id="editUserModal" aria-labelledby="editUserModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Edit user</h4>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="#">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <bi class="bi bi-person"></bi>
                            </span>
                            <input type="text" name="editName" id="editName" class="form-control" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <bi class="bi bi-person-badge"></bi>
                            </span>
                            <select class="form-control" name="editRole" id="editRole">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  <!-- modal for deleting users -->

    <div class="modal fade" id="deleteUserModal" aria-labelledby="deleteUserModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="delForm" action="#">
                        @csrf
                        <div class="mb-3">
                            <h5 class="text-center">Do you want to delete this user?</h5>
                        </div>
                        <div class="mb-3 d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                            <button type="click" id="cancelBtn" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/utilities/users.js')

@endsection

@section('footer')

@endsection