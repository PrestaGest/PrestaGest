<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resources = [
            [
                'resource' => 'products',
                'model' => 'App\Models\Product',
                'fields' => 'name|description|description_short|delivery_in_stock|delivery_out_stock|meta_description|meta_keywords|meta_title|link_rewrite|available_now|available_later|associations',
            ],
            [
                'resource' => 'languages',
                'model' => 'App\Models\Lang',
                'fields' => NULL,
            ],
            [
                'resource' => 'countries',
                'model' => 'App\Models\Country',
                'fields' => 'name',
            ],
            [
                'resource' => 'states',
                'model' => 'App\Models\State',
                'fields' => NULL,
            ],
            [
                'resource' => 'customers',
                'model' => 'App\Models\Customer',
                'fields' => 'associations',
            ],
            [
                'resource' => 'addresses',
                'model' => 'App\Models\CustomerAddress',
                'fields' => NULL,
            ],
            [
                'resource' => 'groups',
                'model' => 'App\Models\CustomerGroup',
                'fields' => 'name',
            ],
            [
                'resource' => 'orders',
                'model' => 'App\Models\Order',
                'fields' => 'associations',
            ],
            [
                'resource' => 'order_details',
                'model' => 'App\Models\OrderDetail',
                'fields' => 'associations',
            ],
            [
                'resource' => 'order_states',
                'model' => 'App\Models\OrderState',
                'fields' => 'name|template',
            ],
            [
                'resource' => 'order_histories',
                'model' => 'App\Models\OrderHistory',
                'fields' => NULL,
            ]
        ];
        DB::table('resources')->insert($resources);
    }
}
