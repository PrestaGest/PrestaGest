<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function getCountry()
    {
        return $this->belongsTo(Country::class, 'id_country', 'id_country');
    }

    public function getState()
    {
        return $this->belongsTo(State::class, 'id_state', 'id_state');
    }
}
