<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
