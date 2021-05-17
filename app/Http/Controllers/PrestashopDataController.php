<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\Order;
use App\Models\State;
use App\Models\Country;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderState;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use App\Models\OrderHistory;
use App\Models\CustomerGroup;
use App\Models\CustomerAddress;
use myfender\PrestashopWebService\PrestashopWebServiceFacade as Prestashop;

class PrestashopDataController extends Controller
{
    /**
     * $resources
     * this variable return association from table => model and the field with json data
     */
    protected $resources = [
        'products' => [
            'model' => Product::class,
            'jsonData' => 'name,description,description_short,delivery_in_stock,delivery_out_stock,meta_description,meta_keywords,meta_title,link_rewrite,available_now,available_later,associations',
        ],
        'languages' => [
            'model' => Lang::class,
        ],
        'countries' => [
            'model' => Country::class,
            'jsonData' =>'name',
        ],
        'states' => [
            'model' => State::class,
        ],
        'customers' => [
            'model' => Customer::class,
            'jsonData' => 'associations',
        ],
        'addresses' => [
            'model' => CustomerAddress::class,
        ],
        'groups' => [
            'model' => CustomerGroup::class,
            'jsonData' => 'name',
        ],
        'orders' => [
            'model' => Order::class,
            'jsonData' => 'associations',
        ],
        'order_details' => [
            'model' => OrderDetail::class,
            'jsonData' => 'associations',
        ],
        'order_states' => [
            'model' => OrderState::class,
            'jsonData' => 'name,template',
        ],
        'order_histories' => [
            'model' => OrderHistory::class,
        ],
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
     * parsingJsonData
     *
     * @param  mixed $resource
     * @param  mixed $data
     * @return void
     */
    protected function parsingJsonData($resource, $data)
    {
        foreach (explode(',', $data) as $field) {
            $resource->$field = json_encode($resource->$field->children());
        }
    }

    /**
     * updateDataFromPrestashop
     *
     * @return void
     */
    public function updateDataFromPrestashop()
    {
        foreach ($this->resources as $key => $data) {
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
                    if (isset($data['jsonData'])) {
                        $this->parsingJsonData($resource, $data['jsonData']);
                    }
                    // assign the data
                    if (!$resource->id) continue;

                    $resource->$id = $resource->id;
                    unset($resource->id);

                    $data['model']::upsert((array)$resource, $id); // call the model with update function
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
        $opt['limit'] = '0,3';
        $xml = Prestashop::get($opt);

        $resources = $xml->$call->children();
        dump($resources);
        // foreach ($resources->product->children() as $resource) {
        //     // dump($resource);
        //     foreach ($resource as $key => $value) {
        //         echo $resource . " - " . $key . ': ' . $value . PHP_EOL . "<br>";
        //     }
    }
    // foreach ($resources->product->children() as $resource) {
    //     dump($resource);
    //     foreach ($resource as $key => $value) {
    //         echo $key . ': ' . $value . PHP_EOL . "<br>";
    //     }
    // }

    /**
     * updateDataFromPrestashop
     *
     * @return void
     */
    public function newTest()
    {
        $product = Product::find(1);
        dump($product);
        dd($product->associations->images->image);
    }
}
