<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($value='')
    {
    	return view('backend.dashboard');
    }
}
