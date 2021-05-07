<?php

namespace App\Models;

use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    public $timestamps = false;

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
        return $this->hasMany(Order::class, 'id_customer', 'id_customer');
    }

    public function getOrderCountAttribute()
    {
        return $this->orders()->count();
    }

    public function getCustomerAddressCountAttribute()
    {
        return $this->customerAddress()->count();
    }

    public function getLifeTimeValueAttribute()
    {
        return $this->orders()->sum('total_paid_real');
    }
}
