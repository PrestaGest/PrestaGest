<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Resources\RelationManager\EditRecord;

class EditCustomerAddress extends EditRecord
{
    // public static $resource = CustomerResource::class;

    protected function beforeSave()
    {
        dd($this->record);
    }
}
