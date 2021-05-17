<?php

namespace App\Orchid\Layouts\Customers;

use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;

class CustomerListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'customers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id_customer', __('ID'))
            ->sort(),

            TD::make('firstname', _('First Name'))
                ->sort()
                ->render(function ($customer) {
                    return Link::make($customer->lastname)
                        ->route('platform.email', $customer);
                }),

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


        TD::make(__('Actions'))
            ->render(function ($model) {
                return $this->getTableActions($model)
                    ->alignCenter()
                    ->autoWidth()
                    ->render();
            }),

        ];
    }

    protected function striped(): bool
    {
        return true;
    }

    /**
     * @param Model $model
     *
     * @return Group
     */
    private function getTableActions($model): Group
    {
        return Group::make([

            // Link::make(__('View'))
            // ->icon('eye')
            // ->route('platform.resource.view', [
            //     $this->resource::uriKey(),
            //     $model->getAttribute($model->getKeyName()),
            // ])
            // ,

            Link::make(__(''))
            ->icon('pencil')
            // ->route('platform.resource.edit', [
            //     $this->resource::uriKey(),
            //     $model->getAttribute($model->getKeyName()),
            // ])
            ,
            // Link::make(__('Delete'))
            // ->icon('trash')
            // ,
        ]);
    }

}
