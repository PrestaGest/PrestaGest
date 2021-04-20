<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $guarded = [];

    /**
     * customer
     *
     * @return void
     */
    public function customers()
    {
        return $this->hasMany(Customer::class, 'id_group', 'id_default_group');
    }
}
