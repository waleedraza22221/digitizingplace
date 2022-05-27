<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSourceFiles extends Model
{
    use HasFactory;
    protected $fillable = [

        'order_id',
        'filename',
        'filepath',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
