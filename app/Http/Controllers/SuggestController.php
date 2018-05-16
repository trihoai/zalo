<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class SuggestController extends Controller
{
    
    public function suggest($id)
    {
        $objects = DB::table('products_relation')
                    ->where('object_1',$id)
                    ->orWhere('object_2', $id)
                    ->orderBy('value', 'desc')
                    ->take(2)
                    ->get();
        return dd($objects);
    }
}
