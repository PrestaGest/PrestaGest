<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Http\Controllers\PrestashopDataController;
use Filament\Resources\RelationManager\CreateRecord;

class CreateCustomerAddress extends CreateRecord
{
    protected function beforeCreate()
    {
        $address = PrestashopDataController::prestashopSendNewData($this->record, 'addresses');
        // dd($address);
        $this->record['id_address'] = $address->id;
        $this->record['date_add'] = $address->date_add;
        $this->record['date_upd'] = $address->date_upd;
    }
}
