<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Http\Requests\StoreorderRequest;
use App\Http\Requests\UpdateorderRequest;
use App\Models\OrderSourceFiles;
use App\Models\Service;
use App\Models\User;
use App\Notifications\QuoteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quote()
    {
        $services = Service::all();
        return view('quote', compact('services'));
    }

    public function postquote(Request $request)
    {
        // dd($request->all());


        // if (request()->hasFile('sourcefiles')) {

        //     $files = request()->file('sourcefiles');

        //     foreach ($files as $file) {

        //         $request->file('file')->store('uploads');
        //         $file->store('file');
        //         $filepath = "/sourcefiles";
        //         $extension = $file->getClientOriginalExtension();
        //         //dd($filename);//
        //         $stre = Storage::disk('local')->put($file->getFilename() . '.' . $extension,  File::get($file));
        //         //$path = $file->storeAs($filepath, $fileName, 'local');
        //         // dd($path);
        //         //$path = Storage::disk('public')->put("/sourcefiles/" . date('YMD') . "/" . rand(10, 10000), $fileName);
        //         dd($stre);
        //         OrderSourceFiles::create([
        //             'order_id' => $order->id,
        //             'filename' => "",
        //             'filepath' => $filepath
        //         ]);
        //     }
        // }

        $allowedfileExtension = ['ai', 'gif', 'pdf', 'jpg', 'png', 'docx', 'zip', 'eps', 'heic', 'jpeg', 'docx'];
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'service_id' => $request->service_id,
            'budget' => $request->budget,
            'description' => $request->description,
            'status' => 'Quote',

        ]);
        $fileP = "sourcefiles/" . time();

        if ($request->hasFile('sourcefiles')) {
            $files = $request->file('sourcefiles');
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                //dd($filename);
                if ($check) {
                    $filepath = $file->storeAs($fileP, $filename, 'public');
                    OrderSourceFiles::create([
                        'order_id' => $order->id,
                        'filename' => $filename,
                        'filepath' => $filepath
                    ]);
                }
            }

            // return redirect()->route('home')->with('message', 'Quote has been sent You will soon Get Email with all details');
        }
        $offerData = [
            'description' => 'BOGO',
            'body' => 'You received an offer.',
            'thanks' => 'Thank you',
            'offerText' => 'Check out the offer',
            'budget' => '200',
            'offer_id' => 007
        ];


        $users = User::where('role_id', '=', 1)->get();

        Notification::send($users, new QuoteNotification($offerData));

        return redirect()->route('home')->with('message', 'Quote has been sent You will soon Get Email with all details');
    }
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreorderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreorderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateorderRequest  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateorderRequest $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
