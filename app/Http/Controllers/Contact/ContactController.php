<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact.index');
    }
}
