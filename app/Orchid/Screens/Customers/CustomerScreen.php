<?php

namespace App\Orchid\Screens\Customers;

use App\Models\Order;
use App\Models\Customer;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
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
            'customers' => Customer::with(['orders', 'customerAddress'])->filters()->defaultSort('id_customer', 'desc')->paginate(),
            'total_order' => Order::all(),
            // 'total_address' => CustomerAddress::count(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Export Customer')
                ->method('export')
                ->icon('cloud-download')
                ->rawClick()
                ->novalidate(),

            Link::make(__('New Customer'))
                ->icon('plus')
                ->route('platform.customer.create'),
        ];
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

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        $customer = Customer::findOrFail($request->get('id'));

        if ($customer->orders->count() == 0)
            $customer->customerAddress()->delete();

        $customer->delete();

        Toast::info(__('Customer was removed'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        return response()->streamDownload(function () {
            $csv = tap(fopen('php://output', 'wb'), function ($csv) {
                fputcsv($csv, ['header:col1', 'header:col2', 'header:col3']);
            });

            collect([
                ['row1:col1', 'row1:col2', 'row1:col3'],
                ['row2:col1', 'row2:col2', 'row2:col3'],
                ['row3:col1', 'row3:col2', 'row3:col3'],
            ])->each(function (array $row) use ($csv) {
                fputcsv($csv, $row);
            });

            return tap($csv, function ($csv) {
                fclose($csv);
            });
        }, 'File-name.csv');
    }
}
