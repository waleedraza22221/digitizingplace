<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderAddon;
use App\Models\OrderTransaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderInfo extends Component
{
    public $status;
    public $text;
    public $totalorder;
    public $orderaddons;
    public $orders;

    public function mount()
    {
        $this->mountComponent();
    }

    public function mountComponent()
    {
        $this->status = 'Quote';
        $this->totalorder = Order::where('user_id', '=', Auth::user()->id)->get();
        $this->orderaddons = OrderTransaction::with(['order' => function ($q) {
            $q->where('user_id', '=', Auth::user()->id)->where('status', '=', $this->status);
        }])->sum('amount');
        $this->orders = Order::where('user_id', '=', Auth::user()->id)->where('status', '=', $this->status)->with('ordertransactions')->get();
        // dd($this->orders);
    }

    public function render()
    {

        return view('livewire.order-info', [
            'totalorder' => $this->totalorder,
            'orderaddons' => $this->orderaddons
        ]);
    }


    public function changeEvent($value)
    {
        //dd($value);

        $this->orders = Order::where('user_id', '=', Auth::user()->id)->where('status', '=', $value)->with('ordertransactions')->get();
       // dd($this->orders);
    }
}
