<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $borrowedToday = Borrow::whereDate('created_at', $today)->count();
        $returnedToday = Borrow::whereDate('return_date', $today)
                               ->where('status', 'returned')
                               ->count();

        return view('dashboard.dashboard', compact('borrowedToday', 'returnedToday'));
    }
}
