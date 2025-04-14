<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CircularController extends Controller
{
    public function index()
    {
        return view('circulaires');
    }
}
