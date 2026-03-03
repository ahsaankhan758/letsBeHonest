<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;



class AdminDashboardController extends Controller
{
    public function index() {
    if (auth('admin')->check()) {
        $userCount = User::count(); 
        $adminCount = Admin::count();

        return view('admin.dashboard', compact('userCount', 'adminCount'));
    }

    return redirect()->back();
}
}
