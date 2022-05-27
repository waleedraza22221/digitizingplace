<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderConversationFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_conversation_id',
        'filename',
        'filepath',
    ];

    public function order()
    {
        return $this->belongsTo(OrderConversation::class);
    }
}
