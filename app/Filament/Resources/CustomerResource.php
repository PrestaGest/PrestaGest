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
                                '1' => __('Male'),
                                '2' => __('Female'),
                            ])->label(__('Gender')),

                        Components\BelongsToSelect::make('id_default_group')
                            ->relationship('customerGroup', 'name')
                            ->preload(),

                        Components\BelongsToSelect::make('id_lang')
                            ->relationship('customerLang', 'name')
                            ->preload(),

                        Components\DatePicker::make('birthday')
                            ->displayFormat($format = 'F j, Y')
                            ->format($format = 'Y-m-d'),

                        Components\DateTimePicker::make('date_add')
                            ->displayFormat($format = 'F j, Y H:i:s')
                            ->format($format = 'Y-m-d H:i:s')
                            ->disabled(),
                    ]
                )->columns(4),

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
                Columns\Text::make('id_gender')
                    ->label(__('Gender'))
                    ->options([
                        '0' => '-',
                        '1' => 'Male',
                        '2' => 'Female',
                    ])->sortable()->default(0),
                Columns\Text::make('newsletter')
                    ->label(__('Newsletter'))
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No',
                    ])->sortable()->default(0),
                Columns\Text::make('active')
                    ->label(__('Active'))
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
            RelationManagers\CustomerAddressesRelationManager::class,
            RelationManagers\OrdersRelationManager::class,
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
