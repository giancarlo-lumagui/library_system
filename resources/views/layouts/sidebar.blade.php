@extends('layouts.default')
@vite('resources/css/layouts/sidebar.css')

  <div class="sidebar d-flex flex-column p-3">
    <h4 class="text-white mb-4">My System</h4>

    <ul class="nav nav-pills flex-column mb-auto">

      <!-- Dashboard -->
      <li class="nav-item">
        <a href="#" class="nav-link text-white">
          <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
      </li>

      <!-- Books -->
      <li class="nav-item">
        <a href="#" class="nav-link text-white">
          <i class="bi bi-book me-2"></i> Books
        </a>
      </li>

      <!-- Users -->
      <li class="nav-item">
        <a href="#" class="nav-link text-white">
          <i class="bi bi-person me-2"></i> Users
        </a>
      </li>

      <!-- logout -->
    <li class="nav-item">
        <a href="#" class="nav-link text-white">
          <i class="bi bi-arrow-left me-2"></i> Logout
        </a>
      </li>

    </ul>
  </div>
