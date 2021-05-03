<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Http\Controllers\PrestashopDataController;
use Filament\Resources\RelationManager\EditRecord;

class EditCustomerAddress extends EditRecord
{

    protected function beforeSave()
    {
        PrestashopDataController::prestashopSendUpdateData($this->record->toArray(), 'addresses');
    }
}
