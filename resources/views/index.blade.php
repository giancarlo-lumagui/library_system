@extends('layouts.default')

@vite('resources/css/index.css')

@section('login')
    <div class="container form-div d-flex justify-content-center align-items-center">
        <form class="border p-5 shadow rounded" action="{{ route('login') }}" method="POST">
            @csrf
            <h4 class="my-4 text-center">
                <b>LIBRARY</b>
                <i id="system-word">System</i>
            </h4>
            <div class="input-group my-4">
                <span class="input-group-text">
                    <bi class="bi bi-person"></bi>
                </span>
                <input type="text" name="name" class="form-control" placeholder="Enter your username..." required>
            </div>
            <div class="input-group my-4">
                <span class="input-group-text">
                    <bi class="bi bi-key"></bi>
                </span>
                <input type="password" name="password" class="form-control" placeholder="Enter your password..." required>
            </div>
            <div class="my-4">
                <button class="btn btn-outline-danger mt-3 w-100">Login</button>
            </div>
            <div class="my-4 d-flex flex-column">
                <sub><a href="">Forgot password?</a></sub> <br>
                <sub>Contact registrar 0923-541-2312</sub>
            </div>

        </form>
    </div>
@endsection