<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderConversation extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'issentbyclient',
        'order_id'
    ];
    public function ordersourcefiles()
    {
        return $this->hasMany(OrderConversationFile::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
