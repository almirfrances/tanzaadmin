<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $title = 'Admin Dashboard';

        return view('dashboard.index', compact('title'));
    }
}
