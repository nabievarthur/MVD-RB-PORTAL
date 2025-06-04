<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->with('roles');

        $users = $users->cursorPaginate(10);

        return view('pages.admin.user.index', compact('users'));
    }
}
