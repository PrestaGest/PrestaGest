<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function getStatus()
    {
        return $this->hasOne(OrderState::class, 'id_order_state', 'current_state');
    }
}
