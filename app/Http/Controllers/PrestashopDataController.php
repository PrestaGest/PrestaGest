<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\Order;
use App\Models\State;
use App\Models\Country;
use App\Models\Customer;
use App\Models\OrderState;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use App\Models\CustomerGroup;
use App\Models\OrderHistory;
use App\Models\CustomerAddress;
use myfender\PrestashopWebService\PrestashopWebServiceFacade as Prestashop;

class PrestashopDataController extends Controller
{
    /**
     * $resources
     * this variable return association from table => model
     */
    protected $resources = [
        'languages' => Lang::class,
        'countries' => Country::class,
        'states' => State::class,
        'customers' => Customer::class,
        'addresses' => CustomerAddress::class,
        'groups' => CustomerGroup::class,
        'orders' => Order::class,
        'order_details' => OrderDetail::class,
        'order_states' => OrderState::class,
        'order_histories' => OrderHistory::class,
    ];

    /**
     * flushScreen, send to video
     *
     * @param  mixed $function
     * @param  mixed $id
     * @return void
     */
    public function flushScreen($function, $id)
    {
        if (ob_get_level() == 0) {
            ob_start();
        }
        echo $function['resource'] . ": " . $id . "\n";
        ob_flush();
        flush();
    }

    /**
     * updateDataFromPrestashop
     *
     * @return void
     */
    public function updateDataFromPrestashop()
    {
        foreach ($this->resources as $key => $model) {

            // assign name resource
            $opt['resource'] = $key;
            $xml = Prestashop::get($opt);

            $counting = count($xml->$key->children()); /// count resources
            $increment = 5000; // this limit need for timeout

            $opt['display'] = 'full';
            $opt['sort'] = '[id_ASC]'; // order

            for ($i = 0; $i < $counting; $i += $increment) {
                $opt['limit'] = $i . ',' . $increment;
                // call webservice
                $xml = Prestashop::get($opt);
                $resources = $xml->$key->children();
                foreach ($resources as $resource) {
                    $this->flushScreen($opt, $resource->id); //this call send to video the result
                    $id = "id_" . Str::singular($key); // setting the id "id_customer" for example

                    // assign the data
                    if ($resource->id) {
                        $resource->$id = $resource->id;
                    } else {
                        continue; // if ID is empty
                    }
                    $resource->$id = $resource->id;
                    if ($key == "order_states" || $key == 'countries' || $key == 'groups') {
                        $resource->name = $resource->name->children();
                    }
                    unset($resource->id);
                    $model::upsert((array)$resource, $id); // call the model with update function
                }
            }
            unset($opt);
        }
        return "PrestaShop data Imported or Updated";
    }

    /**
     * prestashopSendUpdateData
     *
     * @param  mixed $data
     * @param  mixed $resource
     * @return void
     */
    public static function prestashopSendUpdateData($data, $resource)
    {
        $data['id'] = $data['id_' . Str::singular($resource)];
        $xmlSchema = Prestashop::getSchema($resource);
        $sendXmlData = Prestashop::fillSchema($xmlSchema, $data, false);
        Prestashop::edit([
            'resource' => $resource,
            'putXml' => $sendXmlData->asXml(),
            'id'    => $data['id']
        ]);
    }

    /**
     * prestashopSendNewData
     *
     * @param  mixed $data
     * @param  mixed $resource
     * @return void
     */
    public static function prestashopSendNewData($data, $resource)
    {
        $xmlSchema = Prestashop::getSchema($resource);
        $sendXmlData = Prestashop::fillSchema($xmlSchema, $data, false);
        $insert = Prestashop::add([
            'resource' => $resource,
            'postXml' => $sendXmlData->asXml(),
        ]);
        return $insert->{Str::singular($resource)};
    }

    public function test($call = 'products')
    {
        // leggo gli ID prodotti da PS
        $opt['resource'] = $call;
        $opt['display'] = 'full';
        $opt['limit'] = '0,100';
        $xml = Prestashop::get($opt);

        $resources = $xml->$call->children();
        dd($resources);
    }
}
