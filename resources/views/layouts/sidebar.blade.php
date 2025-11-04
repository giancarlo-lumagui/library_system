@extends('layouts.default')
@vite('resources/css/layouts/sidebar.css')

  <div class="sidebar d-flex flex-column p-3">
    <h4 class="text-white mb-4">Library <i>System</i></h4>

    <ul class="nav nav-pills flex-column mb-auto">

      <!-- Dashboard -->
      <li class="nav-item">
        <a href="#" class="nav-link text-white">
          <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
      </li>

      <!-- Books -->
      <li class="nav-item">
        <a href="{{ route('books') }}" class="nav-link text-white">
          <i class="bi bi-book me-2"></i> Books
        </a>
      </li>

      <!-- Borrow Books -->
      <li class="nav-item">
        <a href="{{ route('borrow') }}" class="nav-link text-white">
          <i class="bi bi-book-half me-2"></i> Borrow Books
        </a>
      </li>

    @if (Auth::user()->role === 'admin')
        <!-- Members -->
        <li class="nav-item">
          <a href="{{ route('members') }}" class="nav-link text-white">
            <i class="bi bi-people me-2"></i> Members
          </a>
        </li>

        <!-- Users -->
        <li class="nav-item">
          <a href="{{ route('users') }}" class="nav-link text-white">
            <i class="bi bi-person me-2"></i> Users
          </a>
        </li>
    @endif

    <!-- logout -->
    <li class="nav-item">
        <form id="logoutForm" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button" id="logoutBtn" class="nav-link text-white bg-transparent border-0 w-100 text-start">
                <i class="bi bi-arrow-left me-2"></i> Logout
            </button>
        </form>
    </li>


    </ul>
  </div>
