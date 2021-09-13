<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use AsSource, Filterable, Attachable;

    const CREATED_AT = 'date_add';
    const UPDATED_AT = 'date_upd';

    protected $guarded = [];
    protected $allowedSorts = [
        'id_customer',
        'lastname',
        'firstname',
        'email',
        'gender',
        'newsletter',
        'active',
        'orders',
        'customerAddress',
        'LifeTimeValue',
    ];
    protected $allowedFilters = [
        'id_customer',
        'lastname',
        'firstname',
        'email',
        'gender',
        'newsletter',
        'active',
        'orders',
        'customerAddress',
        'LifeTimeValue',
    ];
    // public $timestamps = false;

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

    // public function getOrderCountAttribute()
    // {
    //     return $this->orders()->count();
    // }

    public function getCustomerAddressCountAttribute()
    {
        return $this->customerAddress()->count();
    }

    public function getLifeTimeValueAttribute()
    {
        return $this->orders()->sum('total_paid_real');
    }

    public function getDateAddForHumansAttribute()
    {
        return $this->date_add->format('d M Y H:m:s');
    }

    public function getDateUpdForHumansAttribute()
    {
        return $this->date_upd->format('d M Y H:m:s');
    }
}
