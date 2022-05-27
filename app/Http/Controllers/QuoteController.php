<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderConversation;
use App\Models\OrderConversationFile;
use App\Models\User;
use App\Notifications\QuoteNotification;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as Notification;
use Illuminate\Support\Facades\Storage;


class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = Order::select('*')->where('user_id', '=', Auth::user()->id)->with('ordersourcefiles')->with('user')->with('service')->orderByDesc('created_at')->get();
        //dd($data);
        if ($request->ajax()) {
            $data = Order::select('*')->where('user_id', '=', Auth::user()->id)->where('status', '=', 'Quote')->with('ordersourcefiles')->with('user')->with('service')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('quote.index');
    }



    public function awaitingpayments(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::select('*')->where('user_id', '=', Auth::user()->id)->where('status', '=', 'Awaiting Payments')->with('orderaddons')->with('ordersourcefiles')->with('user')->with('service')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $btn = '<button class="edit btn btn-primary btn-sm" data-toggle="modal" data-target="#paymodel" data-id="' . $row->id . '"  data-amount="' . $row->orderaddons->sum('amount') . '" >Pay Now</button>';

                    return $btn;
                })
                ->rawColumns(['edit'])
                ->make(true);
        }
        return view('quote.awaitingpayments');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(Order::find($request->id)->first());
        // dd(Gate::allows('can-chat', Order::find($request->id)->first()));
        $isallow = Gate::allows('can-chat', Order::find($request->id));

        if ($isallow) {
            $allowedfileExtension = ['ai', 'gif', 'pdf', 'jpg', 'png', 'docx', 'zip', 'eps', 'heic', 'jpeg', 'docx'];
            $orderchat = OrderConversation::create([
                'message' => $request->message,
                'issentbyclient' => true,
                'order_id' => $request->id

            ]);
            $fileP = "sourcefiles/" . time();

            if ($request->hasFile('sfiles')) {
                $files = $request->file('sfiles');
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    //dd($filename);
                    if ($check) {
                        $filepath = $file->storeAs($fileP, $filename, 'public');
                        OrderConversationFile::create([
                            'order_conversation_id' => $orderchat->id,
                            'filename' => $filename,
                            'filepath' => $filepath
                        ]);
                    }
                }
            }
            $order = Order::where('id', $request->id)->with('ordersourcefiles')->with('service')->first();
            $orderchat = OrderConversation::where('order_id', '=', $order->id)->with('ordersourcefiles')->get();




            return  view('quote.view', compact('order', 'orderchat'));
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('id', $id)->where('status', '=', 'Quote')->with('ordersourcefiles')->with('service')->first();
        if ($order) {
            $orderchat = OrderConversation::where('order_id', '=', $order->id)->with('ordersourcefiles')->get();
            // dd($orderchat);
            return Auth::user()->id === $order->user_id
                ? view('quote.view', compact('order', 'orderchat'))
                : Response::deny('You do not own this post.');
        }
        return response('Order Not Found', 404);
    }

    public function downloadfile(Request $request)
    {

        if (Auth::user()->orders->find($request->quoteid)) {
            $filetodownload = Order::find($request->quoteid);
            $ffile = $filetodownload->ordersourcefiles->where('filename', $request->filename)->first();
            $path = public_path() . Storage::disk('local')->url($ffile->filepath);
            // dd(public_path() . $path);
            return response()->download(str_replace("/", "\/", $path));
        }

        return abort('403');
    }

    public function downloadfiles(Request $request)
    {
        //  dd(Auth::user()->orders->find($request->quoteid)->orderconversations->find($request->chatid));

        if (Auth::user()->orders->find($request->quoteid)->orderconversations->find($request->chatid)) {
            $filetodownload = OrderConversation::find($request->chatid);

            $ffile = $filetodownload->ordersourcefiles->where('filename', $request->filename)->first();
            //dd($ffile);
            $path = public_path() . Storage::disk('local')->url($ffile->filepath);
            // dd(public_path() . $path);
            return response()->download(str_replace("/", "\/", $path));
        }

        return abort('403');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
