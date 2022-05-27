<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddon extends Model
{
    use HasFactory;

    protected $fillable = [

        'order_id',
        'service_addon_id',
        'description',
        'amount'

    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function serviceaddon()
    {
        return $this->belongsTo(Service_Addon::class);
    }
}
