<?php

namespace Database\Factories;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            [
                'resource' => 'products',
                'model' => Product::class,
                'fields' => 'name,description,description_short,delivery_in_stock,delivery_out_stock,meta_description,meta_keywords,meta_title,link_rewrite,available_now,available_later,associations',
            ],
            [
                'resource' => 'languages',
                'model' => Lang::class,
            ],
            [
                'resource' => 'countries',
                'model' => Country::class,
                'fields' => 'name',
            ],
            [
                'resource' => 'states',
                'model' => State::class,
            ],
            [
                'resource' => 'customers',
                'model' => Customer::class,
                'fields' => 'associations',
            ],
            [
                'resource' => 'addresses',
                'model' => CustomerAddress::class,
            ],
            [
                'resource' => 'groups',
                'model' => CustomerGroup::class,
                'fields' => 'name',
            ],
            [
                'resource' => 'orders',
                'model' => Order::class,
                'fields' => 'associations',
            ],
            [
                'resource' => 'order_details',
                'model' => OrderDetail::class,
                'fields' => 'associations',
            ],
            [
                'resource' => 'order_states',
                'model' => OrderState::class,
                'fields' => 'name,template',
            ],
            [
                'resource' => 'order_histories',
                'model' => OrderHistory::class,
            ],
        ];
    }
}
