<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderList extends Component
{
    public $postCount;
    public $orders;
    protected $listeners = ['postAdded' => 'incrementPostCount'];
    public function incrementPostCount()
    {
        $this->postCount = Order::count();
    }
    public function mount($status)
    {
        // dd($status);
        $this->orders = Order::where('status', '=', '')->get();
    }

    public function render()
    {
        return view('livewire.order-list');
    }
}
