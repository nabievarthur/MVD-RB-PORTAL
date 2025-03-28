<?php

namespace App\Http\Controllers\Chief;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChiefController extends Controller
{
    public function index()
    {
        return view('pages.chief.index');
    }
}
