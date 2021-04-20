<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class CustomerAddressesRelationManager extends RelationManager
{
    public static $primaryColumn = 'id_address';

    public static $relationship = 'customerAddresses';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                //
            ]);
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
