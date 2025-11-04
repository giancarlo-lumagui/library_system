@extends('layouts.default')

@vite('resources/css/dashboard/dashboard.css')

@section('aside')
    @include('layouts.sidebar')
@endsection

@section('main')


    <div class="container p-5">
        <div class="text-center mb-4">
            <h2>Dashboard Reports</h2>
            <p class="text-muted">Daily overview of library activity</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Borrowed Today -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center p-3">
                    <i class="bi bi-journal-arrow-down text-primary" style="font-size:2rem"></i>
                    <h5 class="mt-2">Books Borrowed Today</h5>
                    <h3 class="fw-bold text-primary">{{ $borrowedToday }}</h3>
                </div>
            </div>

            <!-- Returned Today -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center p-3">
                    <i class="bi bi-arrow-repeat text-success" style="font-size:2rem"></i>
                    <h5 class="mt-2">Books Returned Today</h5>
                    <h3 class="fw-bold text-success">{{ $returnedToday }}</h3>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <div class="row g-4 justify-content-center">
            <!-- Books -->
            <div class="col-md-3">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <i class="bi bi-book" style="font-size:2rem"></i>
                        <h5 class="mt-2">Books</h5>
                        <a href="{{ route('books') }}" class="btn btn-primary btn-sm mt-2">Go to Books</a>
                    </div>
                </div>
            </div>

            <!-- Members -->
            <div class="col-md-3">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <i class="bi bi-people" style="font-size:2rem"></i>
                        <h5 class="mt-2">Members</h5>
                        <a href="{{route('members')}}" class="btn btn-success btn-sm mt-2">Go to Members</a>
                    </div>
                </div>
            </div>

            <!-- Borrows -->
            <div class="col-md-3">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <i class="bi bi-journal-arrow-down" style="font-size:2rem"></i>
                        <h5 class="mt-2">Borrows</h5>
                        <a href="{{route('borrow')}}" class="btn btn-warning btn-sm mt-2">Go to Borrows</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @vite('resources/js/dashboard/dashboard.js')

@endsection

@section('footer')

@endsection