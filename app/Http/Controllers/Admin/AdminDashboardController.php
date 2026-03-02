<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\User;
use App\Models\Tree;
use App\Models\Project;
use Illuminate\Http\Request;


class AdminDashboardController extends Controller
{
    public function index(){
        if(auth('admin')->check()){
            
            return view('admin.dashboard');
        }
        return redirect()->back();
        

    }
}
