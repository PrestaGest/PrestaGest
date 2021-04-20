<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\CustomerGroup;
use Illuminate\Http\Response;
use App\Models\CustomerAddress;
use myfender\PrestashopWebService\PrestashopWebServiceFacade as Prestashop;

class PrestashopDataController extends Controller
{
    public function prestashopUpdateCustomers()
    {
        // update CustomerResource
        $opt['resource'] = 'customers';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->customers->children();
        foreach ($resources as $resource) {
            $resource->id_customer = $resource->id;
            unset($resource->id);
            Customer::upsert((array)$resource, 'id_customer');
        }
        return response("INSERTED/UPDATED " . count($resources) . " CUSTOMERS", Response::HTTP_CREATED);
    }

    public function prestashopUpdateCustomerAddresses()
    {
        // update CustomerResource
        $opt['resource'] = 'addresses';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->addresses->children();
        foreach ($resources as $resource) {
            $resource->id_address = $resource->id;
            unset($resource->id);
            if ($resource->id_customer == 0) $resource->id_customer = 1;
            CustomerAddress::upsert((array)$resource, 'id_address');
        }
        return response("INSERTED/UPDATED " . count($resources) . " ADDRESSES", Response::HTTP_CREATED);
    }

    public function prestashopUpdateOrders()
    {
        // update OrderResource
        $opt['resource'] = 'orders';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->orders->children();
        // dd($resources);
        foreach ($resources as $resource) {
            $resource->id_order = $resource->id;
            unset($resource->id);
            Order::upsert((array)$resource, 'id_order');
            // foreach ($resource->associations->children()->children() as $res) {
            //     $res->order_id = $resource->id_order;
            //     $row = OrderDetail::updateOrCreate((array)$res);
            // }
        }
        return response("INSERTED/UPDATED " . count($resources) . " ORDERS", Response::HTTP_CREATED);
    }

    public function prestashopUpdateLanguage()
    {
        $opt['resource'] = 'languages';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->languages->children();
        // dd($resources);
        foreach ($resources as $resource) {
            $resource->id_lang = $resource->id;
            unset($resource->id);
            Lang::upsert((array)$resource, 'id_lang');
        }
        return response("INSERTED/UPDATED " . count($resources) . " Lang", Response::HTTP_CREATED);
    }

    public function prestashopUpdateOrderDetails()
    {
        $opt['resource'] = 'order_details';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->order_details->children();
        foreach ($resources as $resource) {
            // dump((int)$resource->associations->taxes->tax->children());
            // $resource->tax = (int)$resource->associations->taxes->tax->children();
            $resource->id_order_detail = $resource->id;
            unset($resource->id);
            unset($resource->associations);
            OrderDetail::upsert((array)$resource, 'id_order_detail');
        }
        return response("INSERTED/UPDATED " . count($resources) . " ORDERS Detail", Response::HTTP_CREATED);
    }

    public function prestashopUpdateGroups()
    {
        // update OrderResource
        $opt['resource'] = 'groups';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->groups->children();
        // dd($resources);
        foreach ($resources as $resource) {
            $resource->id_group = $resource->id;
            unset($resource->id);
            $resource->name = $resource->name->children();
            CustomerGroup::upsert((array)$resource, 'id_group');
        }
        return response("INSERTED/UPDATED " . count($resources) . " GROUP", Response::HTTP_CREATED);
    }

    public function prestashopUpdateProducts()
    {
        // update OrderResource
        $opt['resource'] = 'products';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->products->children();
        dd($resources);
        foreach ($resources as $order) {
            Product::updateOrCreate((array)$order);
            foreach ($order->associations->children()->children() as $orderDetail) {
                $orderDetail->order_id = $order->id;
                $row = OrderDetail::updateOrCreate((array)$orderDetail);
            }
        }
        return response("INSERTED/UPDATED " . count($resources) . " PRODUCTS WITH " . $row->count() . " ROWS", Response::HTTP_CREATED);
    }

    public function prestashopUpdateAll()
    {
        $this->prestashopUpdateGroups();
        $this->prestashopUpdateCustomers();
        $this->prestashopUpdateCustomerAddresses();
        $this->prestashopUpdateOrders();
        $this->prestashopUpdateOrderDetails();
        $this->prestashopUpdateLanguage();
        return ('Database updated successfully!');
    }

    public function updatePrestashopDataStandard($call = "orders", $model = "Order", $full = true)
    {
        $opt['resource'] = $call;
        if($full) $opt['display'] = 'fully';
        $xml = Prestashop::get($opt);
        $resources = $xml->$call->children();
        foreach ($resources as $resource) {
            $id = "id_" . ucfirst($model);
            $resource->$id = $resource->id;
            unset($resource->id);
            $model::upsert((array)$resource, 'id_order');
        }
    }

    public function test($call = 'languages')
    {
        // leggo gli ID prodotti da PS
        $opt['resource'] = $call;
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->$call->children();
        dd($resources);
        // faccio il foreach degli ID per recuperare gli altri dati
        foreach ($resources as $id_customer) {

            //dati ordine
            $opt['id'] = $id_customer->attributes();
            $xmlProd = Prestashop::get($opt)->children();
            $data = (array) $xmlProd->children();

            //dati cliente
            $cli['resource'] = 'customers';
            $cli['id'] = $xmlProd->children()->id_customer;
            $customer = Prestashop::get($cli)->children()->children();
            $data['customer'] = (array) $customer;

            //indirizzo spedizione
            $del['resource'] = 'addresses';
            $del['id'] = $xmlProd->children()->id_address_delivery;
            $deliver = Prestashop::get($del)->children()->children();
            $data['delivery_address'] = (array) $deliver;

            //indirizzo fatturazione
            $inv['id'] = $xmlProd->children()->id_address_invoice;
            $invoice = Prestashop::get($del)->children()->children();
            $data['invoice_address'] = (array) $invoice;

            //stato ordine
            $sta['resource'] = 'order_states';
            $sta['id'] = $xmlProd->children()->current_state;
            $invoice = Prestashop::get($sta)->children()->children();
            $data['order_states'] = (array) $invoice;

            // creo l'array da inviare al noSql
            $array[(int)$opt['id']] = $data;
        }

        //risposta positiva
        if (isset($array)) return response(json_encode($array), Response::HTTP_CREATED);

        //risposta negativa
        return response('NULLA DA INSERIRE', Response::HTTP_OK);
    }

    // funzione che restituisce i valori dal db noSql
    public function readOrder($id = NULL)
    {
        if (isset($id)) {
            return response($this->snapshot->getChild($id)->getValue(), Response::HTTP_OK); // se esiste un id
        } else {
            foreach ($this->snapshot->getValue() as $key => $value) {
                if (is_null($value)) continue;
                $response[] = $value;
            }
        }
        return response($response, Response::HTTP_OK); // se non esiste
    }
}
