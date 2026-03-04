<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    // public function index(){
    //     return view('treebank');
    // }

    public function index()
    {
        return redirect()->away('https://www.w3schools.com/', 301);
    }

    // public function react()
    // {
    //     return view('app');
    // }
}
