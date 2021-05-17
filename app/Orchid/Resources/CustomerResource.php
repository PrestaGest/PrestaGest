<?php

namespace App\Orchid\Resources;

use Orchid\Screen\TD;
use App\Models\Customer;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;

class CustomerResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Customer::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('firstname')
                ->title(__('Firstname'))
                ->placeholder('Enter the firstname'),
            // lastname, email, id_gender, id_default_group, birthday, newsletter, active, id_lang (hidden), date_add, date_upd
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id_customer', __('ID')),

            TD::make('firstname', _('First Name'))
                ->sort(),

            TD::make('lastname', __('Last name'))
                ->sort(),


            TD::make('id_gender', __('Gender'))
                ->sort(),
            TD::make('newsletter', __('Newsletter'))
                ->sort(),
            TD::make('active', __('Active'))
                ->sort(),
            TD::make('order_count', __('Order Count'))
                ->sort(),
            TD::make('customer_address_count', __('Address Count')),
            TD::make('life_time_value', __('Order Value')),


            // TD::make('created_at', 'Date of creation')
            //     ->render(function ($model) {
            //         return $model->date_add;
            //     }),

            // TD::make('updated_at', 'Update date')
            //     ->render(function ($model) {
            //         return $model->date_upd;
            //     }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }
}
