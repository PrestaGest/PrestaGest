<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CustomerResource;
use App\Http\Controllers\PrestashopDataController;
class EditCustomer extends EditRecord
{
    public static $resource = CustomerResource::class;

    protected function beforeSave()
    {
        PrestashopDataController::prestashopSendUpdateData($this->record->toArray(), 'customers');
    }
}
