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
use App\Models\OrderPayment;
use App\Models\CustomerGroup;
use Illuminate\Http\Response;
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
        'customers' => Customer::class,
        'addresses' => CustomerAddress::class,
        'groups' => CustomerGroup::class,
        'orders' => Order::class,
        'order_details' => OrderDetail::class,
        'order_states' => OrderState::class,
        'languages' => Lang::class,
        'countries' => Country::class,
        'states' => State::class,
        'order_histories' => OrderHistory::class
    ];

    /**
     * flushScreen
     *
     * @param  mixed $function
     * @param  mixed $id
     * @return void
     */
    public function flushScreen($function, $id)
    {
        if (ob_get_level() == 0) ob_start();
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
        // foreach resources
        foreach ($this->resources as $key => $model) {
            // assign name resource
            $opt['resource'] = $key;
            $opt['display'] = 'full';
            // call webservice
            $xml = Prestashop::get($opt);
            // split resource to children
            $resources = $xml->$key->children();
            $counting = count($resources);
            $increment = 5000;
            for ($i = 0; $i < $counting; $i += $increment) {
                foreach ($resources as $resource) {
                    // this call put a video result
                    $this->flushScreen($opt, $resource->id);
                    // setting the id "id_customer" for example
                    $id = "id_" . Str::singular($key);
                    // assign the data
                    $resource->$id = $resource->id;
                    if($key == "order_states" || $key == 'countries'){
                        $resource->name = $resource->name->children();
                    }
                    unset($resource->id);
                    // call the model with update function
                    $model::upsert((array)$resource, $id);
                }
            }
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
}
