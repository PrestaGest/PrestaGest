<?php

namespace App\Models;

use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function customerAddress()
    {
        return $this->hasMany(CustomerAddress::class, 'id_customer', 'id_customer');
    }

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class, 'id_default_group', 'id_group');
    }

    public function customerLang()
    {
        return $this->belongsTo(Lang::class, 'id_default_lang', 'id_lang');
    }
    public function orders()
    {
        return $this->belongsTo(Order::class, 'id_customer', 'id_customer');
    }
}
