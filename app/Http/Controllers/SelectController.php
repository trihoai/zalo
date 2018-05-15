<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\value;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SelectController extends Controller
{
    public function select()
    {
        $value = value::orderBy('value','desc')->take(5)->get();
        return view('select',['value'=>$value]);
    }

}
