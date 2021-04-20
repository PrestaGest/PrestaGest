<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'id_customer', 'id_customer');
    }
}
