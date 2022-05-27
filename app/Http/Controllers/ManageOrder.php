<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageOrder extends Controller
{

    public function index($id)
    {
        // dd($id);.




        $order = Order::where('id', '=', $id)->with('service')->with('orderconversations')
            ->with('ordertransactions')->with('orderaddons')->with('ordersourcefiles')->first();
        // dd($order->user_id);
        if ($order->user_id === auth()->user()->id) {

            return view('manageorder.index', compact('order'));
        }
        return abort(403);
    }
}
