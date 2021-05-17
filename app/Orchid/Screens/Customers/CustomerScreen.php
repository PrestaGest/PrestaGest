<?php

namespace App\Orchid\Screens\Customers;

use App\Models\Customer;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Customers\CustomerListLayout;

class CustomerScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Customers';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of the customers in your system';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'customers' => Customer::filters()->defaultSort('id_customer', 'desc')->paginate()
        ];
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
        return [
            Layout::columns([
                new CustomerListLayout('', 'Customer List'),
            ]),
        ];
    }
}
