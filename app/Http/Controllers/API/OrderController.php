<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zalo\Zalo;
use Zalo\ZaloEndpoint;
use Zalo\ZaloConfig;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function getListOrder()
    {
        $users = 
        [
            [
                'order' => 
                [
                    [
                        'product_id' => 1,
                        'time' => new Carbon('2010-05-16 22:40:10'),
                    ],
                    [
                        'product_id' => 2,
                        'time' => new Carbon('2010-05-20 22:40:10'),
                    ],
                    [
                        'product_id' => 6,
                        'time' => new Carbon('2010-05-27 22:40:10'),
                    ],
                ],
            ],
            [
                'order' => 
                [
                    [
                        'product_id' => 4,
                        'time' => new Carbon('2010-05-16 22:40:10'),
                    ],
                    [
                        'product_id' => 5,
                        'time' => new Carbon('2010-6-3 22:40:10'),
                    ],
                    [
                        'product_id' => 2,
                        'time' => new Carbon('2010-7-2 22:40:10'),
                    ],
                ],
            ],
            [
                'order' => 
                [
                    [
                        'product_id' => 1,
                        'time' => new Carbon('2010-05-16 22:40:10'),
                    ],
                    [
                        'product_id' => 6,
                        'time' => new Carbon('2010-05-24 22:40:10'),
                    ],
                    [
                        'product_id' => 2,
                        'time' => new Carbon('2010-05-20 22:40:10'),
                    ],
                ],
            ],
        ];
        $products_relation = array(['product_id_1' => 0, 
                                    'product_id_2' => 0, 
                                    'value' => 0]);
        array_shift($products_relation);
        $last_user = end($users);
        foreach ($users as $user) {
            for($i = 0; $i < 3; $i++){
                for($j = $i+1; $j < 3; $j++){
                    $range = $user['order'][$j]['time']->diffInDays($user['order'][$i]['time']);
                    $product_id_1 = $user['order'][$i]['product_id'];
                    $product_id_2 = $user['order'][$j]['product_id'];
                    if($range < 7 ) {
                        $value = 3;
                    }
                    elseif($range < 14 ) {
                        $value = 2;
                    }
                    elseif($range < 30 ) {
                        $value = 1;
                    }else{
                        $value = 0;
                    }
                    if ($product_id_1 > $product_id_2) {
                        list($product_id_1, $product_id_2) = array($product_id_2, $product_id_1);
                    }
                    if (sizeof($products_relation) < 5) {
                        array_push($products_relation, ['product_id_1' => $product_id_1, 
                                                'product_id_2' => $product_id_2, 
                                                'value' => $value]);
                    }if(sizeof($products_relation) >= 5 || ($user == $last_user && $i==1 && $j==2)){
                        foreach ($products_relation as $product) {
                            $product_id_1 = $product['product_id_1'];
                            $product_id_2 = $product['product_id_2'];
                            $value = $product['value'];
                            $object = DB::table('products_relation')
                                    ->where('object_1',$product_id_1)
                                    ->where('object_2',$product_id_2)->first();
                            if ($object == NULL) {
                                DB::table('products_relation')->insert([
                                    'object_1' => $product_id_1,
                                    'object_2' => $product_id_2,
                                    'value' => $value
                                ]);
                            }else{
                                $object->value += $value;
                                $object = DB::table('products_relation')
                                    ->where('object_1',$product_id_1)
                                    ->where('object_2',$product_id_2)
                                    ->update(['value' => $object->value]);
                            }
                            array_forget($products_relation, $product);
                        }
                    }
                }
            }
        }
        dd(DB::table('products_relation')->get());
    }
}
