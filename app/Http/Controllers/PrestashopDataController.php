<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Support\Str;
use myfender\PrestashopWebService\PrestashopWebServiceFacade as Prestashop;

class PrestashopDataController extends Controller
{
    /**
     * flushScreenToAvoidTimeout, send to video
     *
     * @param  mixed $function
     * @param  mixed $id
     * @return void
     */
    public function flushScreenToAvoidTimeout($function, $id)
    {
        if (ob_get_level() == 0) {
            ob_start();
        }
        echo $function['resource'] . ": " . $id . "\n";
        ob_flush();
        flush();
    }

    /**
     * parsingArrayDataToJson
     *
     * @param  mixed $resource
     * @param  mixed $data
     * @return void
     */
    protected function parsingArrayDataToJson($resource, $data)
    {
        foreach (explode('|', $data) as $field) {
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
        foreach (Resource::whereActive(1)->get() as $data) {
            $key = $data->resource;
            $model = $data->model;

            $opt['resource'] = $key;
            $xml = Prestashop::get($opt);

            $countingResources = count($xml->$key->children());
            $increment = 5000; // this limit need for timeout

            $opt['display'] = 'full';
            $opt['sort'] = '[id_ASC]';

            for ($i = 0; $i < $countingResources; $i += $increment) {
                $opt['limit'] = $i . ',' . $increment;

                $xml = Prestashop::get($opt);
                $resources = $xml->$key->children();

                foreach ($resources as $resource) {
                    if ($resource->id) {
                        $this->flushScreenToAvoidTimeout($opt, $resource->id);
                        $id = "id_" . Str::singular($key);

                        if (isset($data->fields))
                            $this->parsingArrayDataToJson($resource, $data->fields);

                        $resource->$id = $resource->id;
                        unset($resource->id);
                        $model::upsert((array)$resource, 'id');
                    }
                }
            }
            unset($opt);
        }
        return "PrestaShop data Imported or Updated";
    }

    /**
     * sendUpdateDataToPrestashop
     *
     * @param  mixed $data
     * @param  mixed $resource
     * @return void
     */
    public static function sendUpdateDataToPrestashop($data, $resource)
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
     * sendNewDataToPrestashop
     *
     * @param  mixed $data
     * @param  mixed $resource
     * @return void
     */
    public static function sendNewDataToPrestashop($data, $resource)
    {
        $xmlSchema = Prestashop::getSchema($resource);
        $sendXmlData = Prestashop::fillSchema($xmlSchema, $data, false);
        $insert = Prestashop::add([
            'resource' => $resource,
            'postXml' => $sendXmlData->asXml(),
        ]);
        return $insert->{Str::singular($resource)};
    }


    /**
     * test
     *
     * @param  mixed $call
     * @param  mixed $call2
     * @return void
     */
    public function test($call = 'images', $call2 = '')
    {
        if (!empty($call2)) $call = $call . '/' . $call2;

        $opt['resource'] = $call;
        $opt['display'] = 'full';
        $opt['limit'] = '0,3';
        $xml = Prestashop::get($opt);
        dump($opt);

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
        $product = \App\Models\Product::find(1);
        dump($product);
        dd($product->associations->images->image);
    }
}
