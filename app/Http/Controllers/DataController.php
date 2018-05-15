<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\value;

class DataController extends Controller
{
   public function data()
   {
       $user = [
           [

               'order' =>[
                   [
                       'object_id' => 1,
                       'time' => 1,
                   ],

                   [
                       'object_id' => 2,
                       'time' => 2,
                   ]]
           ],
           [

               'order' =>[
                   [
                       'object_id' => 3,
                       'time' => 1,
                   ],

                   [
                       'object_id' => 1,
                       'time' => 4,
                   ]]
           ],
           [

               'order' =>[
                   [
                       'object_id' => 1,
                       'time' => 2,
                   ],

                   [
                       'object_id' => 0,
                       'time' => 5,
                   ]]
           ]
       ];
       $dt = array(
           array(0, 0, 0, 0),
           array(0, 0, 0, 0),
           array(0, 0, 0, 0),
           array(0, 0, 0, 0),
       );
       for ($i = 0; $i < 3; $i++)
           for ($j = 0; $j < 1; $j++) {
               $t = $j + 1;
               $a = $user[$i]['order'][$j]['object_id'];
               $b = $user[$i]['order'][$t]['object_id'];
               $time1 = $user[$i]['order'][$j]['time'];
               $time2 = $user[$i]['order'][$t]['time'];
               $time = $time2 - $time1;
               if ($time < 2) {
                   $dt[$a][$b] = 3;
                   $dt[$b][$a] =3;
               } elseif ($time < 3) {
                   $dt[$a][$b] = 2;
                   $dt[$b][$a] =2;
               } elseif ($time < 4) {
                   $dt[$a][$b] = 1;
                   $dt[$b][$a] =1;
               }

           }

       for ($i = 0; $i < 4; $i++)
           for ($j = $i+1; $j < 4; $j++)
           {
               $value = new value();
               $value->object_id1 = $i;
               $value->object_id2 = $j;
               $value->object_id3 = 0;
               $value->value = $dt[$i][$j];
               $value->save();
           }
   }
}
