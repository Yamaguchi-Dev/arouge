<?php

namespace App\Lib;
use App\Models\Shipment;

class Func
{
    public static function getSearch($search_req, $sess_name){
          if (empty($sess_name)) return array();

          $search_arr = array();
          if (session()->has($sess_name)) $search_arr = session()->get($sess_name);
          if (count($search_req->all()) > 0) {
              $search_arr = $search_req->all();
             if (!array_key_exists('_token', $search_req->all()) and session()->has($sess_name))
                 foreach (session()->get($sess_name) as $k => $v) {
                     if ($k == "page") continue;
                     $search_arr[$k] = $v;
                 }
          }
          session()->put($sess_name, $search_arr);

          return $search_arr;

    }

}
