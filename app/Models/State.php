<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = [];

    public function country(){
        return $this->hasOne(Country::class, 'id_country', 'id_state');
    }
}
