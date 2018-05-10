<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zalo\Zalo;
use Zalo\ZaloEndpoint;
use Zalo\ZaloConfig;

class OrderController extends Controller
{
    public function getListOrder()
    {
        $zalo = new Zalo(ZaloConfig::getInstance()->getConfig());
        $data = array(
            'offset' => 0,
            'count' => 10, //get 10 order
            'filter' => 1  //get new order
        );
        $params = ['data' => $data];
        $response = $zalo->get(ZaloEndpoint::API_OA_STORE_GET_SLICE_ORDER, $params);
        $result = $response->getDecodedBody(); // result
        return dd($result);
    }
}
