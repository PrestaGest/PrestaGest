<?php

namespace App\Orchid\Screens\Customers;

use Orchid\Screen\Screen;

class CustomerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit/Create Customer';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit or Create a new Customer';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
