<?php

namespace App\Filament\Resources;

use App\Models\User;
use App\Filament\Roles;
use Filament\Resources\Resource;
use Filament\Resources\Forms\Form;
use Filament\Resources\Tables\Table;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Forms\Components;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\Fieldset::make(
                    'Customer Data',
                    [
                        Components\TextInput::make('firstname')
                            ->autofocus()
                            ->required()
                            ->label(__('Firstname')),

                        Components\TextInput::make('lastname')
                            ->autofocus()
                            ->required()
                            ->label(__('Lastname')),

                        Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique($table = 'customers', $column = 'email', $exceptCurrentRecord = true)
                            ->label(__('Email')),
                        Components\Select::make('id_gender')
                            ->placeholder(__('Gender'))
                            ->options([
                                '1' => __('Male'),
                                '2' => __('Female'),
                            ])->label(__('Gender')),

                        Components\BelongsToSelect::make('id_default_group')
                            ->relationship('customerGroup', 'name')
                            ->preload(),

                        Components\BelongsToSelect::make('id_lang')
                            ->relationship('customerLang', 'name')
                            ->preload(),
                    ]
                )->columns(3),
                // Components\Fieldset::make(
                //     __('Address'),
                //     [
                //         Components\TextInput::make('address_1')
                //             ->required()
                //             ->label(__('Address 1')),
                //         Components\TextInput::make('address_2')->label(__('Address 2')),
                //         Components\TextInput::make('city')
                //             ->required()
                //             ->label(__('City')),
                //         Components\TextInput::make('state')
                //             ->required()
                //             ->label(__('State')),
                //         Components\TextInput::make('post_code')
                //             ->required()
                //             ->label(__('Post Code')),
                //         Components\TextInput::make('country_code')->label(__('Country Code')),
                //     ]
                // )->columns(3),
                // Components\Fieldset::make(
                //     __('Other Data'),
                //     [
                //         Components\Select::make('checkin_hour')
                //             ->placeholder('Checkin Hour')
                //             ->options([
                //                 '12:00'     => '12:00',
                //                 '12:30'     => '12:30',
                //                 '13:00'     => '13:00',
                //                 '13:30'     => '13:30',
                //                 '14:00'     => '14:00',
                //                 '14:30'     => '14:30',
                //                 '15:00'     => '15:00',
                //                 '15:30'     => '15:30',
                //                 '16:00'     => '16:00',
                //                 '16:30'     => '16:30',
                //             ])
                //             ->default('15:00')
                //             ->label(__('Checkin Hour')),
                //         Components\Select::make('checkout_hour')
                //             ->placeholder('Checkout Hour')
                //             ->options([
                //                 '9:00'  => '9:00',
                //                 '9:30'  => '9:30',
                //                 '10:00' => '10:00',
                //                 '10:30' => '10:30',
                //                 '11:00' => '11:00',
                //                 '11:30' => '11:30',
                //                 '12:00' => '12:00',
                //                 '12:30' => '12:30',
                //             ])
                //             ->default('10:30')
                //             ->label(__('Checkout Hour')),
                //         Components\Select::make('active')
                //             ->placeholder('Select status')
                //             ->options([
                //                 '0' => 'No',
                //                 '1' => 'Yes',
                //             ])->default(0)->label(__('Active')),
                //         Components\TextInput::make('latitude')->label(__('Latitude')),
                //         Components\TextInput::make('longitude')->label(__('Longitude')),

                // (auth()->user()->is_admin
                //     ?
                //     Components\Select::make('user_id')
                //     ->options($aaa = User::whereIsAdmin(0)
                //         ->pluck('name', 'id')
                //         ->toArray())
                //     :
                //     Components\TextInput::make('user_id')->default(auth()->user()->id)->hidden()),
                // ]
                // )->columns(3),
                // Components\Fieldset::make(
                //     _('Description'),
                //     [
                //         Components\RichEditor::make('description')
                //             ->label(__('Description'))
                //             ->enableToolbarButtons($buttons = [])
                //             ->disableToolbarButtons($buttons = ['heading', 'subheading']),
                //         Components\RichEditor::make('term_cond')
                //             ->label(__('Terms and Conditions'))
                //             ->enableToolbarButtons($buttons = [])
                //             ->disableToolbarButtons($buttons = ['heading', 'subheading']),
                //     ]
                // )->columns(2),
            ])->columns(1);
    }

    /**
     * table
     *
     * @param  mixed $table
     * @return void
     */
    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('id')
                    ->label(__('ID'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('firstname')
                    ->label(__('Firstname'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('lastname')
                    ->label(__('Lastname'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('email')
                    ->label(__('Email'))
                    ->url(fn ($customer) => "mailto:{$customer->email}")
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('id_gender')
                    ->label(__('Gender'))
                    ->options([
                        '1' => 'Male',
                        '0' => 'Female',
                    ])->sortable()->default(0),
                Columns\Text::make('newsletter')
                    ->label(__('Newsletter'))
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No',
                    ])->sortable()->default(0),

                Columns\Text::make('customerGroup.name')
                    ->label(__('Group'))
                    ->sortable()->default(0),
            ])

            ->filters([
                Filter::make(__('Active'), fn ($query) => $query->where('active', 1)),
                Filter::make(__('Newsletter'), fn ($query) => $query->where('newsletter', 1)),
            ]);
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListCustomers::routeTo('/', 'index'),
            Pages\CreateCustomer::routeTo('/create', 'create'),
            Pages\EditCustomer::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
