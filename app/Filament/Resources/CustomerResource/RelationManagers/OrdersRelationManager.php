<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Resources\Forms\Form;
use Filament\Resources\Tables\Table;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Columns;
use Filament\Resources\RelationManager;
use Filament\Resources\Forms\Components;
use App\Filament\Resources\Tables\Columns\OrderState;

class OrdersRelationManager extends RelationManager
{
    public static $primaryColumn = 'id_order';

    public static $relationship = 'orders';

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
                Columns\Text::make('id_order')
                    ->label(__('ID'))
                    ->primary()
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('reference')
                    ->label(__('Reference'))
                    ->primary()
                    ->searchable()
                    ->sortable(),

                OrderState::make('getStatus.name')
                    ->label(__('Order State'))
                    ->searchable()
                    ->primary()
                    ->sortable(),

                // Columns\View::make('getStatus.name')
                //     ->data(['color' => 'getStatus->color'])
                //     ->primary()
                //     ->view('filament.tables.cells.order-state'),

                Columns\Text::make('payment')
                    ->label(__('Payment'))
                    ->primary()
                    ->searchable()
                    ->sortable(),

                Columns\Text::make('total_paid_tax_excl')
                    ->label(__('Total without Tax'))
                    ->currency($symbol = '€', $decimalSeparator = '.', $thousandsSeparator = ',', $decimals = 2)
                    ->searchable()
                    ->primary()
                    ->sortable(),
                Columns\Text::make('total_paid_tax_incl')
                    ->label(__('Total with Tax'))
                    ->currency($symbol = '€', $decimalSeparator = '.', $thousandsSeparator = ',', $decimals = 2)
                    ->primary()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ]);
    }
}
