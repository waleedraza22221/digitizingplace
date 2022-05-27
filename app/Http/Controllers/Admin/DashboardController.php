<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Policies\AdminDashboardPolicy;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class DashboardController extends Controller
{

    public function __construct(Gate $gate)
    {

        $this->middleware('can:view-dashboard');
    }


    public function index()
    {
        //dd(auth()->user()->is_admin());
        $notifications = auth()->user()->unreadNotifications;
        // dd($notifications);
        // return view('home', );
        return view('admin.dashboard.index', compact('notifications'));
    }

}
