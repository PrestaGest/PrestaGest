<?php

namespace App\Orchid\Layouts\Customers;

use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

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
                ->filter(TD::FILTER_TEXT),


            TD::make('lastname', __('Last name'))
                ->sort()
                ->filter(TD::FILTER_TEXT),

            TD::make('email', __('Email'))
                ->sort()
                ->filter(TD::FILTER_TEXT),


            TD::make('id_gender', __('Gender'))
                ->sort()
                ->render(function ($field) {
                    $a =  __("-");
                    if ($field->id_gender == 1) {
                        $a = __('Male');
                    } elseif ($field->id_gender == 2) {
                        $a = __('Female');
                    }
                    return $a;
                }),
            TD::make('newsletter', __('Newsletter'))
                ->sort()
                ->render(function ($field) {
                    return ($field->newsletter == 1 ? __('Yes') : __('No'));
                }),
            TD::make('active', __('Active'))
                ->sort()
                ->render(function ($field) {
                    return ($field->active == 1 ? __('Yes') : __('No'));
                }),
            TD::make('order_count', __('N° Orders'))
                // ->sort()
                ->align(TD::ALIGN_RIGHT)
                ->render(function ($field) {
                    return $field->orders->count();
                }),
            TD::make('customer_address_count', __('Addr.'))
                // ->sort()
                ->align(TD::ALIGN_RIGHT)
                ->render(function ($field) {
                    return $field->customerAddress->count();
                }),

            TD::make('life_time_value', __('Order Value'))
                // ->sort()
                ->align(TD::ALIGN_RIGHT)
                ->render(function ($field) {
                    return "€ " . number_format($field->life_time_value, 2);
                }),


            // TD::make(__('Actions'))
            //     ->render(function ($model) {
            //         return $this->getTableActions($model)
            //             ->alignCenter()
            //             ->autoWidth()
            //             ->render();
            //     }),


            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('130px')
                ->render(function ($customer) {
                    return
                        Group::make([
                            Link::make(__(''))
                                ->icon('pencil'),

                            DropDown::make()
                                ->icon('options-vertical')
                                ->list([
                                    Link::make(__('Edit'))
                                        // ->route('platform.customer.edit', $customer->id)
                                        ->icon('pencil'),

                                    Button::make(__('Delete'))
                                        ->icon('trash')
                                        ->method('remove')
                                        ->confirm(__('Once the customer is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                        ->parameters([
                                            'id' => $customer->id,
                                        ]),
                                ]),
                        ]);
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

    /**
     * @return string
     */
    protected function iconNotFound(): string
    {
        return 'table';
    }

    /**
     * @return string
     */
    protected function textNotFound(): string
    {
        return __('There are no records in this view');
    }

    /**
     * @return string
     */
    protected function subNotFound(): string
    {
        return '';
    }

    public function total(): array
    {
        return [
            TD::make('total')
                ->align(TD::ALIGN_RIGHT)
                ->colspan(7)
                ->render(function () {
                    return '<b>TOTAL:</b>';
                }),

            TD::make('total_order')
                ->align(TD::ALIGN_RIGHT)
                ->render(function ($data) {
                    return '<b>' . $data['total_order']->count() . '</b>';
                }),

            TD::make('total_address')
                ->align(TD::ALIGN_RIGHT)
                ->render(function ($data) {
                    return '<b>' . $data['total_address'] . '</b>';
                }),

            TD::make('total_order')
                ->align(TD::ALIGN_RIGHT)
                ->style(Color::PRIMARY())
                ->render(function ($data) {
                    return "<b>€ " . number_format($data['total_order']->sum('total_paid_real'), 2) . '</b>';
                }),
        ];
    }
}
