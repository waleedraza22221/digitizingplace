<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'service_id'
    ];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
