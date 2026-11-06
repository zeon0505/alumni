<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $alumni = Auth::guard('alumni')->user()->load('dataAkademik');
        return view('dashboard.index', compact('alumni'));
    }
}
