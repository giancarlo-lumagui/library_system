@extends('layouts.default')

@section('aside')
@include('layouts.sidebar')
@endsection

@section('main')
<div class="btns p-2 d-flex justify-content-end">
    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
        <i class="bi bi-plus"></i> Add Member
    </button>
</div>

<div class="container-fluid p-2">
    <table class="table table-border">
        <thead class="table-dark">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="memberList"></tbody>
    </table>
</div>

<!-- modal for adding members -->
<div class="modal fade" id="addMemberModal" aria-labelledby="addMemberModalLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add member</h4>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form id="formData">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="firstName" class="form-control" placeholder="Enter first name..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="lastName" class="form-control" placeholder="Enter last name..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-envelope "></i></span>
                        <input type="text" id="email" class="form-control" placeholder="Enter email..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                        <input type="text" id="phone" class="form-control" placeholder="Enter phone number..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-house"></i></span>
                        <input type="text" id="address" class="form-control" placeholder="Enter address..." required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal for editing members -->
<div class="modal fade" id="editMemberModal" aria-labelledby="editMemberModalLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Edit member</h4>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="editFirstName" class="form-control" placeholder="Enter first name..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="editLastName" name="editLastName" class="form-control" placeholder="Enter last name..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-envelope "></i></span>
                        <input type="text" id="editEmail" name="editEmail" class="form-control" placeholder="Enter email..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                        <input type="text" id="editPhone" name="editPhone" class="form-control" placeholder="Enter phone number..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-house"></i></span>
                        <input type="text" id="editAddress" name="editAddress" class="form-control" placeholder="Enter address..." required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@vite('resources/js/books/members.js')
@endsection
