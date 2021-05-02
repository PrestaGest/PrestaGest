<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\Order;
use App\Models\State;
use App\Models\Country;
use App\Models\Customer;
use App\Models\OrderState;
use App\Models\OrderDetail;
use App\Models\OrderPayment;
use App\Models\CustomerGroup;
use Illuminate\Http\Response;
use App\Models\OrderHistories;
use App\Models\CustomerAddress;
use myfender\PrestashopWebService\PrestashopWebServiceFacade as Prestashop;

class PrestashopDataController extends Controller
{
    public function flushScreen($function, $id)
    {
        if (ob_get_level() == 0) ob_start();
        echo $function['resource'] . ": " . $id . "\n";
        ob_flush();
        flush();
    }

    public function prestashopUpdateCustomers()
    {
        // update CustomerResource
        $opt['resource'] = 'customers';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->customers->children();
        foreach ($resources as $resource) {
            $this->flushScreen($opt, $resource->id);
            $resource->id_customer = $resource->id;
            unset($resource->id);
            Customer::upsert((array)$resource, 'id_customer');
        }
        return response("INSERTED/UPDATED " . count($resources) . " CUSTOMERS", Response::HTTP_CREATED);
    }

    public function prestashopUpdateCustomerAddresses()
    {
        // for timeout
        if (ob_get_level() == 0) ob_start();
        // update CustomerResource
        $opt['resource'] = 'addresses';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->addresses->children();
        foreach ($resources as $resource) {
            $this->flushScreen($opt, $resource->id);
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
            $this->flushScreen($opt, $resource->id);
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

    public function prestashopUpdateLanguages()
    {
        $opt['resource'] = 'languages';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->languages->children();
        // dd($resources);
        foreach ($resources as $resource) {
            $this->flushScreen($opt, $resource->id);
            $resource->id_lang = $resource->id;
            unset($resource->id);
            Lang::upsert((array)$resource, 'id_lang');
        }
        return response("INSERTED/UPDATED " . count($resources) . " Lang", Response::HTTP_CREATED);
    }

    public function prestashopUpdateCountries()
    {
        $opt['resource'] = 'countries';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->countries->children();
        // dd($resources);
        foreach ($resources as $resource) {
            $this->flushScreen($opt, $resource->id);
            $resource->id_country = $resource->id;
            unset($resource->id);
            $resource->name = $resource->name->children();
            Country::upsert((array)$resource, 'id_country');
        }
        return response("INSERTED/UPDATED " . count($resources) . " Countries", Response::HTTP_CREATED);
    }

    public function prestashopUpdateStates($call = "states", $id = "id_state")
    {
        $opt['resource'] = $call;
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->$call->children();
        foreach ($resources as $resource) {
            $this->flushScreen($opt, $resource->id);
            $resource->$id = $resource->id;
            unset($resource->id);
            State::upsert((array)$resource, $id);
        }
        return response("INSERTED/UPDATED " . count($resources) . " Countries", Response::HTTP_CREATED);
    }

    public function prestashopUpdateOrderDetails()
    {
        $opt['resource'] = 'order_details';
        $xml = Prestashop::get($opt);
        $counting = count($xml->order_details->children());
        $increment = 10000;
        // for ($i = 0; $i < 72000; $i += 1800) {
        //     $sql = "SELECT some expression FROM table WHERE condition LIMIT $i, 1800 INTO OUTFILE '/path/to/sitemap-$i.xml'";
        // }
        for ($i = 0; $i < $counting; $i += $increment) {
            $opt['display'] = 'full';
            $opt['limit'] = $i . ',' . $increment;
            $xml = Prestashop::get($opt);
            $resources = $xml->order_details->children();
            foreach ($resources as $resource) {
                $this->flushScreen($opt, $resource->id);
                // dump((int)$resource->associations->taxes->tax->children());
                // $resource->tax = (int)$resource->associations->taxes->tax->children();
                $resource->id_order_detail = $resource->id;
                unset($resource->id);
                unset($resource->associations);
                OrderDetail::upsert((array)$resource, 'id_order_detail');
            }
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
            $this->flushScreen($opt, $resource->id);
            $resource->id_group = $resource->id;
            unset($resource->id);
            $resource->name = $resource->name->children();
            CustomerGroup::upsert((array)$resource, 'id_group');
        }
        return response("INSERTED/UPDATED " . count($resources) . " GROUP", Response::HTTP_CREATED);
    }

    public function prestashopUpdateOrderStates()
    {
        // update OrderResource
        $opt['resource'] = 'order_states';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->order_states->children();
        // dd($resources);
        foreach ($resources as $resource) {
            $this->flushScreen($opt, $resource->id);
            $resource->id_order_state = $resource->id;
            unset($resource->id);
            $resource->name = $resource->name->children();
            $resource->template = $resource->template->children();
            OrderState::upsert((array)$resource, 'id_order_state');
        }
        return response("INSERTED/UPDATED " . count($resources) . " ORDER STATES", Response::HTTP_CREATED);
    }

    public function prestashopUpdateOrderHistories()
    {
        // update OrderResource
        $opt['resource'] = 'order_histories';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->order_histories->children();
        // dd($resources);
        foreach ($resources as $resource) {
            $this->flushScreen($opt, $resource->id);
            $resource->id_order_history = $resource->id;
            unset($resource->id);
            OrderHistories::upsert((array)$resource, 'id_order_history');
        }
        return response("INSERTED/UPDATED " . count($resources) . " ORDER PAYMENT", Response::HTTP_CREATED);
    }
    public function prestashopUpdateOrderPayments()
    {
        // update OrderResource
        $opt['resource'] = 'order_payments';
        $opt['display'] = 'full';
        $xml = Prestashop::get($opt);
        $resources = $xml->order_payments->children();
        // dd($resources);
        foreach ($resources as $resource) {
            $this->flushScreen($opt, $resource->id);
            $resource->id_order_payment = $resource->id;
            unset($resource->id);
            OrderPayment::upsert((array)$resource, 'id_order_payment');
        }
        return response("INSERTED/UPDATED " . count($resources) . " ORDER PAYMENT", Response::HTTP_CREATED);
    }

    public function test($call = 'order_histories')
    {
        // leggo gli ID prodotti da PS
        $opt['resource'] = $call;
        $opt['display'] = 'full';
        $opt['limit'] = '0,100';
        $xml = Prestashop::get($opt);

        $resources = $xml->$call->children();
        dd($resources);
    }

    public function prestashopUpdateAll()
    {
        $this->prestashopUpdateStates();
        $this->prestashopUpdateCountries();
        $this->prestashopUpdateGroups();
        $this->prestashopUpdateCustomers();
        $this->prestashopUpdateCustomerAddresses();
        $this->prestashopUpdateLanguages();
        $this->prestashopUpdateOrders();
        $this->prestashopUpdateOrderStates();
        $this->prestashopUpdateOrderDetails();
        $this->prestashopUpdateOrderHistories();
        // $this->prestashopUpdateOrderPayments();
        return "Database updated successfully!";
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


    public function updatePrestashopDataStandard($call = "orders", $model = "Order", $full = true)
    {
        $opt['resource'] = $call;
        if ($full) $opt['display'] = 'fully';
        $xml = Prestashop::get($opt);
        $resources = $xml->$call->children();
        foreach ($resources as $resource) {
            $id = "id_" . ucfirst($model);
            $resource->$id = $resource->id;
            unset($resource->id);
            $model::upsert((array)$resource, 'id_order');
        }
    }

    // public function other($call = 'order_states')
    // {
    //     // leggo gli ID prodotti da PS
    //     $opt['resource'] = $call;
    //     $opt['display'] = 'full';
    //     $xml = Prestashop::get($opt);
    //     $resources = $xml->$call->children();
    //     dd($resources);
    //     // faccio il foreach degli ID per recuperare gli altri dati
    //     foreach ($resources as $id_customer) {

    //         //dati ordine
    //         $opt['id'] = $id_customer->attributes();
    //         $xmlProd = Prestashop::get($opt)->children();
    //         $data = (array) $xmlProd->children();

    //         //dati cliente
    //         $cli['resource'] = 'customers';
    //         $cli['id'] = $xmlProd->children()->id_customer;
    //         $customer = Prestashop::get($cli)->children()->children();
    //         $data['customer'] = (array) $customer;

    //         //indirizzo spedizione
    //         $del['resource'] = 'addresses';
    //         $del['id'] = $xmlProd->children()->id_address_delivery;
    //         $deliver = Prestashop::get($del)->children()->children();
    //         $data['delivery_address'] = (array) $deliver;

    //         //indirizzo fatturazione
    //         $inv['id'] = $xmlProd->children()->id_address_invoice;
    //         $invoice = Prestashop::get($del)->children()->children();
    //         $data['invoice_address'] = (array) $invoice;

    //         //stato ordine
    //         $sta['resource'] = 'order_states';
    //         $sta['id'] = $xmlProd->children()->current_state;
    //         $invoice = Prestashop::get($sta)->children()->children();
    //         $data['order_states'] = (array) $invoice;

    //         // creo l'array da inviare al noSql
    //         $array[(int)$opt['id']] = $data;
    //     }

    //     //risposta positiva
    //     if (isset($array)) return response(json_encode($array), Response::HTTP_CREATED);

    //     //risposta negativa
    //     return response('NULLA DA INSERIRE', Response::HTTP_OK);
    // }

    // // funzione che restituisce i valori dal db noSql
    // public function readOrder($id = NULL)
    // {
    //     if (isset($id)) {
    //         return response($this->snapshot->getChild($id)->getValue(), Response::HTTP_OK); // se esiste un id
    //     } else {
    //         foreach ($this->snapshot->getValue() as $key => $value) {
    //             if (is_null($value)) continue;
    //             $response[] = $value;
    //         }
    //     }
    //     return response($response, Response::HTTP_OK); // se non esiste
    // }
}
