<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Customers;

use App\Models\Customer;
use Orchid\Screen\Sight;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\TimeZone;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\DateTimer;
use App\Orchid\Layouts\Customers\CustomerEditLayout;

class CustomerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Customer';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit Form Customer';

    /**
     * @var customer
     */
    private $customer;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Customer $customer): array
    {
        $this->customer = $customer;

        if (!$customer->exists) {
            $this->name = 'Create Customer';
            $this->description = 'Create new Customer';
        }

        return [
            'customer' => $customer,
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
            Button::make(__('Delete'))
                ->icon('trash')
                ->confirm(__('Once the customer is deleted, all of its data will be permanently deleted. If the user has orders, they will not be canceled but will remain orphaned. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->customer->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
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
                Layout::legend('customer', [
                    Sight::make('Data customer')->render(function (Customer $customer) {
                        return 'ID: ' . $customer->id_customer . ' - ' . $customer->firstname . ' ' . $customer->lastname . ' (' . $customer->email . ')';
                    }),

                    Sight::make('Info')->render(function (Customer $customer) {
                        return
                            'Active: ' . ($customer->active === null
                                ? '<i class="text-danger">●</i>'
                                : '<i class="text-success">●</i> ') .

                            'Newsletter: ' . ($customer->newsletter === null
                                ? '<i class="text-danger">●</i>'
                                : '<i class="text-success">●</i> ') .

                            'Gender: ' .
                            ($customer->id_gender !== 0
                                ? ($customer->id_gender === 1
                                    ? 'MALE'
                                    : 'FEMALE')
                                : 'NOT SPECIFIED');
                    }),
                    Sight::make('date_add_for_humans', 'Created'),
                    Sight::make('date_upd_for_humans', 'Updated'),
                    Sight::make('Note')->render(function (Customer $customer) {
                        return $customer->note;
                    }),
                ])->title('Customer Info'),

                Layout::rows([

                    Group::make([
                        Input::make('customer.lastname')
                            ->title(__('Lastname'))
                            ->placeholder('Enter Lastname'),

                        Input::make('customer.firstname')
                            ->title(__('Firstname'))
                            ->placeholder('Enter Firstname'),

                        Input::make('customer.email')
                            ->title('Email')
                            ->placeholder('Enter address'),
                    ]),

                    Group::make([

                        Select::make('customer.id_gender')
                            ->options([
                                1 => 'Male',
                                2 => 'Female',
                            ])
                            ->title('Gender'),

                        DateTimer::make('customer.birthday')
                            ->title('Birthday')
                            ->allowInput()
                            ->serverFormat('d/m/Y')
                            ->format('d/m/Y'),

                        CheckBox::make('customer.active')
                            ->value(1)
                            ->title('Active')
                            ->placeholder('Active'),

                        CheckBox::make('customer.newsletter')
                            ->value(1)
                            ->title('Newsletter')
                            ->placeholder('Newsletter'),
                    ]),

                ])->title('Personal Data'),
                // Layout::block(CustomerEditLayout::class)
                //     ->title(__('Profile Information'))
                //     ->description(__('Update your account\'s profile information and email address.'))
                //     ->commands(
                //         Button::make(__('Save'))
                //             ->type(Color::DANGER())
                //             ->icon('check')
                //             ->canSee($this->customer->exists)
                //             ->method('save')
                //     ),
            ]),
        ];
    }


    // /**
    //  * @param customer    $customer
    //  * @param Request $request
    //  *
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function save(Customer $customer, Request $request)
    // {
    //     $request->validate([
    //         'customer.email' => [
    //             'required',
    //             Rule::unique(customer::class, 'email')->ignore($customer),
    //         ],
    //     ]);

    //     $permissions = collect($request->get('permissions'))
    //     ->map(function ($value, $key) {
    //         return [base64_decode($key) => $value];
    //     })
    //         ->collapse()
    //         ->toArray();

    //     $customerData = $request->get('customer');
    //     if ($customer->exists && (string)$customerData['password'] === '') {
    //         // When updating existing customer null password means "do not change current password"
    //         unset($customerData['password']);
    //     } else {
    //         $customerData['password'] = Hash::make($customerData['password']);
    //     }

    //     $customer
    //         ->fill($customerData)
    //         ->fill([
    //             'permissions' => $permissions,
    //         ])
    //         ->save();

    //     $customer->replaceRoles($request->input('customer.roles'));

    //     Toast::info(__('customer was saved.'));

    //     return redirect()->route('platform.systems.customers');
    // }

    /**
     * @param Request $request
     */
    public function remove(Customer $customer)
    {

        if ($customer->orders->count() == 0)
            $customer->customerAddress()->delete();

        $customer->delete();

        Toast::info(__('Customer was removed'));

        return redirect()->route('platform.customer');
    }
}
