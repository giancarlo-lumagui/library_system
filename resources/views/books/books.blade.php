@extends('layouts.default')

@section('header')


@endsection

@section('aside')
    @include('layouts.sidebar')
@endsection

@section('main')
<div class="btns p-2 d-flex justify-content-end">
    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">
        <i class="bi bi-plus"></i> Add Book
    </button>
</div>

<div class="container-fluid p-2">
    <div class="container-fluid p-3">
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by title or author...">
        </div>
        <div class="col-md-3">
            <select id="genreFilter" class="form-select">

            </select>
        </div>
        <div class="col-md-2">
            <button id="clearFilters" class="btn btn-outline-secondary">Clear Filters</button>
        </div>
    </div>
</div>
    <table class="table table-border">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="bookList"></tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h4>Add Book</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formData">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-book"></i></span>
                        <input type="text" id="title" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="author" class="form-control" placeholder="Author" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                        <input type="text" id="genre" class="form-control" placeholder="Genre" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-123"></i></span>
                        <input type="number" id="quantity" class="form-control" placeholder="Quantity" required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h4>Edit Book</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-book"></i></span>
                        <input type="text" id="editTitle" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="editAuthor" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                        <input type="text" id="editGenre" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-123"></i></span>
                        <input type="number" id="editQuantity" class="form-control" required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-outline-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteBookModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form id="delForm">
                    @csrf
                    <h5>Are you sure you want to delete this book?</h5>
                    <div class="mt-3 d-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@vite('resources/js/books/books.js')
@endsection
