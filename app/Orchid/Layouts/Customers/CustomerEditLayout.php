<?php

namespace App\Orchid\Layouts\Customers;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CustomerEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('customer.lastname')
            ->type('text')
            ->max(255)
                ->required()
                ->title(__('Lastname'))
                ->placeholder(__('Lastname')),

        Input::make('customer.firstname')
            ->type('text')
            ->max(255)
                ->required()
                ->title(__('Firstname'))
                ->placeholder(__('Firstname')),

            Input::make('customer.email')
            ->type('email')
            ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),
        ];
    }
}
