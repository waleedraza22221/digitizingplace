<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Gate $gate)
    {

        $this->middleware('can:view-home');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $status = 'New';
        return view('home', compact('status'));
    }


    public function getnotifications()
    {
        $notifications = auth()->user()->unreadNotifications;
    }
    public function profile()
    {
        return view('profile');
    }
}
