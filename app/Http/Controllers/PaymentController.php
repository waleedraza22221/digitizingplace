<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\TopUp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('processing');
    }
    public function processing()
    {
        return view('processing');
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
        //dd($request);
        if ($request->ajax()) {

            $merchantCode = "250278707506";
            $key = "Z%^H@GwDVIQAny=3O!8?";
            $apiVersion = '6.0';
            $resource = 'orders';
            $host = "https://api.2checkout.com/rest/" . $apiVersion . "/" . $resource . "/" . $request->refid;
            $date = gmdate('Y-m-d H:i:s');
            $string = strlen($merchantCode) . $merchantCode . strlen($date) . $date;
            $hash = hash_hmac('md5', $string, $key);
            $payload = '';
            $ch = curl_init();
            $headerArray = array(

                "Content-Type: application/json",

                "Accept: application/json",

                "X-Avangate-Authentication: code=\"{$merchantCode}\" date=\"{$date}\" hash=\"{$hash}\"",

                'Cookie: XDEBUG_SESSION=PHPSTORM'

            );



            curl_setopt($ch, CURLOPT_URL, $host);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_POST, FALSE);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

            curl_setopt($ch, CURLOPT_SSLVERSION, 0);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);



            $response = curl_exec($ch);
            $data = json_decode($response);
            //  dd($data->ExternalReference);
            if ($data->Status == 'COMPLETE') {
                //         'order_id',
                // 'amount',
                // 'refid',
                // 'comments',
                // 'paidby'
                $user = User::find(Auth::user()->id);
                $ot = OrderTransaction::where('refid', $request->refno)->first();
                if (is_null($ot)) {
                    $bh = new OrderTransaction([
                        'order_id' => $data->ExternalReference,
                        'refid' => $request->refid,
                        'amount' => $request->amount,
                        'comments' => $request->signature,
                        'paidby' => 'Online'
                    ]);
                    $bh->save();
                    $order = Order::where('id', $data->ExternalReference)->first();
                    $order->status = 'New';
                    // $user->balance = $user->balance + $request->amount;
                    $order->save();
                    // return  response()->json(['message' => 'success'], 200);
                }
            }
        }
        return redirect()->route('home')->with('message', 'Order has been placed Successfully');
    }



    public function paybydp(Request $request)
    {
        // dd($request);
        $user = User::find(Auth::user()->id);
        $order = Order::where('id', '=', $request->id)->with('orderaddons')->first();
        // dd($user);
        if (Auth::user()->id == $order->user_id) {
            if ($user->balance >= $order->orderaddons[0]->amount && $order->orderaddons[0]->amount == $request->amount && $order->status == 'Awaiting Payments') {
                $bh = new OrderTransaction([
                    'order_id' => $order->id,
                    'refid' => 'DPP',
                    'amount' => $request->amount,
                    'comments' => $user->email,
                    'paidby' => 'DP'
                ]);
                $bh->save();
                $order = Order::where('id', $request->id)->first();
                $order->status = 'New';
                $order->save();
                $user->balance -= $request->amount;
                $user->save();
                return redirect()->route('home')->with('message', 'Order has been placed successfully');
            }
        }

        return abort(403, 'Unauthorized action.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
