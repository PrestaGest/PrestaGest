<?php

namespace App\Filament\Resources;

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
                                '0' => __('Other'),
                                '1' => __('Male'),
                                '2' => __('Female'),
                            ])
                            ->label(__('Gender'))
                            ->default(1),

                        Components\BelongsToSelect::make('id_default_group')
                            ->relationship('customerGroup', 'name')
                            ->preload()
                            ->default(3),
                        // Components\TextInput::make('passwd')
                        //     ->autofocus()
                        //     ->label(__('Password')),

                        // Components\TextInput::make('date_add')
                        //     ->disabled()
                        //     ->label(__('Date Add')),

                        // Components\TextInput::make('date_upd')
                        //     ->disabled()
                        //     ->label(__('Date Update')),

                        Components\DatePicker::make('birthday')
                            ->displayFormat($format = 'F j, Y')
                            // ->maxDate( Carbon::yesterday()->toDateTimeString())
                            ->format($format = 'Y-m-d'),

                        Components\Toggle::make('newsletter')
                            ->stacked()
                            ->label(__('Newsletter'))
                            ->offIcon('heroicon-s-arrow-right')
                            ->onIcon('heroicon-s-check'),
                        Components\Toggle::make('active')
                            ->stacked()
                            ->label(__('Active'))
                            ->offIcon('heroicon-s-arrow-right')
                            ->onIcon('heroicon-s-check')
                            ->default(1),
                        // Components\Toggle::make('optin')
                        //     ->stacked()
                        //     ->label(__('Optin'))
                        //     ->offIcon('heroicon-s-arrow-right')
                        //     ->onIcon('heroicon-s-check'),
                        Components\TextInput::make('id_lang')
                            ->hidden()
                            ->default(1),
                    ]
                )->columns(4),
                Components\Fieldset::make(
                    'Date',
                    [
                        Components\TextInput::make('date_add')
                            ->label(__('Date Add'))
                            ->disabled(),
                        Components\TextInput::make('date_upd')
                            ->label(__('Date Upd'))
                            ->disabled(),
                    ]
                )->columns(2),

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
                Columns\Text::make('id_customer')
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
                // Columns\Text::make('id_gender')
                //     ->label(__('Gender'))
                //     ->options([
                //         '0' => '-',
                //         '1' => 'Male',
                //         '2' => 'Female',
                //     ])->sortable(),
                Columns\Text::make('newsletter')
                    ->label(__('NL.'))
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No',
                    ])->sortable(),
                Columns\Text::make('active')
                    ->label(__('Act.'))
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No',
                    ])->sortable(),

                Columns\Text::make('order_count')
                    ->label(__('Ord.')),

                Columns\Text::make('customer_address_count')
                    ->label(__('Addr.')),

                Columns\Text::make('life_time_value')
                    ->label(__('Value'))
                    ->currency($symbol = '€ ', $decimalSeparator = '.', $thousandsSeparator = ','),
            ])

            ->filters([
                Filter::make(__('Active'), fn ($query) => $query->where('active', 1)),
                Filter::make(__('Newsletter'), fn ($query) => $query->where('newsletter', 1)),
            ]);
    }

    public static function relations()
    {
        return [
            RelationManagers\OrdersRelationManager::class,
            RelationManagers\CustomerAddressRelationManager::class,
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
