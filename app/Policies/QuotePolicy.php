<?php

namespace App\Policies;

use App\Models\{
    User,
    Order
};
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function canChat(User $user, Order $order)
    {
      //  dd($order);
        return $user->orders()->findOrNew($order->id);
    }
}
