<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProxyListController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }
}
