@extends('layouts.default')

@section('aside')
    @include('layouts.sidebar')
@endsection

@section('main')
<div class="btns p-2 d-flex justify-content-end">
    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#borrowBookModal">
        <i class="bi bi-plus"></i> Borrow Book
    </button>
</div>

<div class="container-fluid p-2">
    <table class="table table-border">
        <thead class="table-dark">
            <tr>
                <th>Member</th>
                <th>Book</th>
                <th>Quantity</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="borrowList"></tbody>
    </table>
</div>

<!-- Borrow Book Modal -->
<div class="modal fade" id="borrowBookModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h4>Borrow Book</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="borrowForm">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <select id="borrowMember" class="form-select" required>
                            <option value="">Select Member</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-book"></i></span>
                        <select id="borrowBook" class="form-select" required>
                            <option value="">Select Book</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-123"></i></span>
                        <input type="number" id="borrowQuantity" class="form-control" placeholder="Quantity" min="1" required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-outline-success">Borrow</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@vite('resources/js/books/borrows.js')
@endsection
