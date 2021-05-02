<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestashopDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('updatecustomers', [PrestashopDataController::class, 'prestashopUpdateCustomers']);
Route::get('updatecustomeraddresses', [PrestashopDataController::class, 'prestashopUpdateCustomerAddresses']);
Route::get('updateorders', [PrestashopDataController::class, 'prestashopUpdateOrders']);
Route::get('updateorderdetails', [PrestashopDataController::class, 'prestashopUpdateOrderDetails']);
Route::get('updateproducts', [PrestashopDataController::class, 'prestashopUpdateProducts']);
Route::get('updatecustomergroups', [PrestashopDataController::class, 'prestashopUpdateGroups']);
Route::get('updateall', [PrestashopDataController::class, 'prestashopUpdateAll']);
Route::get('test/{resource?}', [PrestashopDataController::class, 'test']);
// Route::get('test2', [PrestashopDataController::class, 'updatePrestashopDataStandard']);
