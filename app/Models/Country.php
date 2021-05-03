<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function states()
    {
        $this->belongsToMany(Country::class, 'id_country', 'id_country');
    }
}
