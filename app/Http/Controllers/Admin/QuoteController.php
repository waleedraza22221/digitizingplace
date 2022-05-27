<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DataTables;

class QuoteController extends Controller
{
    public function __construct(Gate $gate)
    {

        $this->middleware('can:view-dashboard');
    }

    public function index(Request $request)
    {
        //$data = Order::all();
        // dd($data);
        if ($request->ajax()) {
            $data = Order::select('*')->with('user')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('view', function ($row) {
                    $btn = '<a target="-new" href="quote/' . $row->id . '" class="edit btn btn-primary btn-sm" data-id="' . $row->id . '" >View </a>';

                    return $btn;
                })
                ->rawColumns(['view'])
                ->make(true);
        }

        return view('admin.quote.index');
    }


    public function show($id)
    {
        $order = Order::where('id', '=', $id)->with(['user', 'service', 'orderconversations' => function ($q) {
            $q->with('ordersourcefiles');
        }, 'ordersourcefiles'])->first();

        $totalorders = Order::where('user_id', '=', $order->user_id)->count();
        //dd($totalorders);
        return view('admin.quote.show', compact('order', 'totalorders'));
    }


    public function sendquote(Request $request)
    {
        //dd($request);
        OrderAddon::create([
            'order_id' => $request->id,
            'description' => $request->description,
            'amount' => $request->amount
        ]);

        $order = Order::find($request->id);
        // dd($order);
        $order->status = 'Awaiting Payments';
        $order->save();

        $order = Order::where('id', '=', $request->id)->with(['user', 'service', 'orderconversations' => function ($q) {
            $q->with('ordersourcefiles');
        }, 'ordersourcefiles'])->first();

        $totalorders = Order::where('user_id', '=', $order->user_id)->count();
        //dd($totalorders);

        return redirect()->route('admin.quote')->with('message', 'Quote Sent');
    }

    //
}
