<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index_page () {
        $users = User::where('type', 'user')->orderByDesc('created_at')->get();
        return view('admin.dashboard', compact('users'));
    }

}
