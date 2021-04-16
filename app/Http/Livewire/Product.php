<?php

namespace App\Http\Livewire;

use Livewire\Component;
use myfender\PrestashopWebService\PrestashopWebService;

class Product extends Component
{
    private $prestashop;

    public function __construct(PrestashopWebService $prestashop)
    {
        $this->prestashop = $prestashop;
    }

    public function getProduct($id = NULL)
    {
        $opt['resource'] = 'products';
        if (isset($id)) {
            $opt['id'] = $id;
        } else {

            $opt['display'] = 'full';
        }
        $xml = $this->prestashop->get($opt);
        dd($xml);
    }

    public function render()
    {
        return view('livewire.product');
    }
}
