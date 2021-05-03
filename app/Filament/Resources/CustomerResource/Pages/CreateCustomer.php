<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CustomerResource;
use App\Http\Controllers\PrestashopDataController;

class CreateCustomer extends CreateRecord
{
    public static $resource = CustomerResource::class;

    protected function beforeCreate()
    {
        $customer = PrestashopDataController::prestashopSendNewData($this->record, 'customers');
        $this->record['id_customer'] = $customer->id;
        $this->record['passwd'] = $customer->passwd;
        $this->record['date_add'] = $customer->date_add;
        $this->record['date_upd'] = $customer->date_upd;
        $this->record['last_passwd_gen'] = $customer->last_passwd_gen;
        $this->record['secure_key'] = $customer->secure_key;
        if (isset($customer->newsletter_date_add))
            $this->record['newsletter_date_add'] = $customer->snewsletter_date_addecure_key;
    }
}
