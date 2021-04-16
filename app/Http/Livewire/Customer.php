<?php

namespace App\Http\Livewire;

use Livewire\Component;
use myfender\PrestashopWebService\PrestashopWebService;
use myfender\PrestashopWebService\PrestashopWebServiceFacade as Prestashop;

class Customer extends Component
{
    private $prestashop;

    public function __construct(PrestashopWebService $prestashop)
    {
        $this->prestashop = $prestashop;
    }

    public function getCustomerOld($id = NULL){
        $opt['resource'] = 'customers';
        if (isset($id)) {
            $opt['id'] = $id;
        } else {

            $opt['display'] = 'full';
        }
        $xml = $this->prestashop->get($opt);
        dd($xml);
    }

    public function getCustomer($id = NULL){
        $opt['resource'] = 'customers';
        if (isset($id)) {
            $opt['id'] = $id;
        } else {

            $opt['display'] = 'full';
        }
        $xml = Prestashop::get($opt);
        dd($xml);
    }
    public function render()
    {
        return view('livewire.customer');
    }
}
