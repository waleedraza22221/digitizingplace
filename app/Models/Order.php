<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'service_id',
        'budget',
        'description',
        'status',
        'duedate',
        'completed_on'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function orderconversations()
    {
        return $this->hasMany(OrderConversation::class);
    }

    public function ordertransactions()
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function orderaddons()
    {
        return $this->hasMany(OrderAddon::class);
    }

    public function ordersourcefiles()
    {
        return $this->hasMany(OrderSourceFiles::class);
    }
}
