<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $with = ['getStatus', 'customer'];


    public function getStatus()
    {
        return $this->hasOne(OrderState::class, 'id_order_state', 'current_state');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function getFullNameAttribute(){
        return "{$this->customer()->firstname} {$this->customer()->lastname}";
    }
}
