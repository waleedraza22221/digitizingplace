<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price'
    ];


    public function service_addons()
    {
        return $this->hasMany(Service_Addon::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
