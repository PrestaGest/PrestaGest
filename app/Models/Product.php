<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $casts = [
        'delivery_in_stock' => 'object',
        'delivery_out_stock' => 'object',
        'link_rewrite' => 'object',
        'name' => 'object',
        'meta_description' => 'object',
        'meta_title' => 'object',
        'meta_keyword' => 'object',
        'description' => 'object',
        'description_short' => 'object',
        'available_now' => 'object',
        'available_later' => 'object',
        'associations' => 'object',
    ];
}
