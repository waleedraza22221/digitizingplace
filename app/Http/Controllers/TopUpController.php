<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Http\Requests\StoreTopUpRequest;
use App\Http\Requests\UpdateTopUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Json;
use DataTables;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = TopUp::select('*')->where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('topup.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTopUpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            if ($data->Status == 'COMPLETE') {
                $user = User::find(Auth::user()->id);
                $topUp = TopUp::where('refid', $request->refno)->first();
                if (is_null($topUp)) {
                    $bh = new TopUp([
                        'refid' => $request->refid,
                        'amount' => $request->amount,
                        'comments' => $request->signature,
                        'user_id' => $user->id
                    ]);
                    $bh->save();
                    $user->balance = $user->balance + $request->amount;
                    $user->save();
                    return  response()->json(['message' => 'success'], 200);
                }
            }
        }
        return redirect()->route('home')->with('message', 'Balance has been added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function show(TopUp $topUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function edit(TopUp $topUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTopUpRequest  $request
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopUpRequest $request, TopUp $topUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopUp $topUp)
    {
        //
    }
}
