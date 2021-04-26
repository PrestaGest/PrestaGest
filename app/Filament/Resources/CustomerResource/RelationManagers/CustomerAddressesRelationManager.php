<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Models\State;
use Filament\Resources\Forms\Form;
use Filament\Resources\Tables\Table;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Columns;
use Filament\Resources\RelationManager;
use Filament\Resources\Forms\Components;

class CustomerAddressesRelationManager extends RelationManager
{
    public static $primaryColumn = 'id_address';

    public static $relationship = 'customerAddresses';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\Fieldset::make(
                    'Customer Address',
                    [
                        Components\TextInput::make('alias')
                            ->autofocus()
                            ->required()
                            ->label(__('Alias')),
                        Components\TextInput::make('firstname')
                            ->autofocus()
                            ->required()
                            ->label(__('Firstname')),
                        Components\TextInput::make('lastname')
                            ->autofocus()
                            ->required()
                            ->label(__('Lastname')),
                        Components\TextInput::make('company')
                            ->autofocus()
                            ->label(__('Company')),
                        Components\TextInput::make('vat_number')
                            ->autofocus()
                            ->label(__('Vat Number')),
                        Components\TextInput::make('address1')
                            ->autofocus()
                            ->required()
                            ->label(__('Address 1')),
                        Components\TextInput::make('address2')
                            ->autofocus()
                            ->label(__('Address 2')),
                        Components\TextInput::make('postcode')
                            ->autofocus()
                            ->required()
                            ->label(__('Postcode')),

                        Components\BelongsToSelect::make('id_country')
                            ->label(__('Country'))
                            ->relationship('getCountry', 'name')
                            ->preload()
                            ->dependable(),

                        Components\BelongsToSelect::make('id_state')
                            ->label(__('State'))
                            ->when(
                                fn ($record) => $record->id_country !== null,
                                fn ($field, $record) => $field->relationship(
                                    'getState',
                                    'name',
                                    fn ($query) => $query->where('id_country', $record->id_country)
                                )
                            )
                            ->preload(),

                        Components\TextInput::make('city')
                            ->label(__('City')),

                        Components\TextInput::make('phone')
                            ->autofocus()
                            ->label(__('Phone')),
                        Components\TextInput::make('phone_mobile')
                            ->autofocus()
                            ->label(__('Phone Mobile')),
                        Components\TextInput::make('other')
                            ->autofocus()
                            ->label(__('Note')),
                    ]
                )->columns(2),

            ])->columns(1);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('id_address')
                    ->label(__('ID'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('alias')
                    ->label(__('Alias'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('lastname')
                    ->label(__('Lastname'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('firstname')
                    ->label(__('Firstname'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('city')
                    ->label(__('City'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('company')
                    ->label(__('Company'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('vat_number')
                    ->label(__('Vat'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('date_upd')
                    ->label(__('Date Update'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ]);
    }
}
