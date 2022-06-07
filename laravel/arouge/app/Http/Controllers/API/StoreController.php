<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{

    public function arouge_city()
    {
        $data = array();
        $pref_id = request('pref');
        if (!empty($pref_id)) {
            $city = config('citycode.code')[$pref_id];
            foreach ($city as $k => $v) {

                $store_query = Store::where('address', 'LIKE', "%$v%")->where('view_status', '=', 1)->where('status', '=', 1);
                if ($store_query->count() > 0) {
                    $city_data = array();
                    $city_data["code"] = $k;
                    $city_data["label"] = $v;

                    $data['data'][] = $city_data;
                }
            }
        }
        return $this->resConversionJson($data);
    }

    public function arouge_search()
    {
        $data = array();
        $city_id = request('city');
        $keyword = request('keyword');
        $page = request('page');
        if (empty($page)) {
            $page = 1;
        }
        $limit = 10;

        $store_query = Store::where('view_status', '=', 1)->where('status', '=', 1);
        if(!empty($city_id)) {
            $city_data = array();
            foreach (config('citycode.code') as $k => $v) {
                foreach ($v as $k2 => $v2) {
                    $city_data[$k2] = $v2;
                }
            }
            $address = $city_data[$city_id];

            $store_query->where('address', 'LIKE', "%$address%");
        }
        if(!empty($keyword)) {
            $store_query->where(function($q2) use($keyword) {
                    $q2->orWhere('name', 'LIKE', "%$keyword%");
                    $q2->orWhere('zipcode', 'LIKE', "%$keyword%");
                    $q2->orWhere('address', 'LIKE', "%$keyword%");
            });
        }

        if ($store_query->count() > 0) {
            $data["meta"]["total"] = $store_query->count();
            $data["meta"]["limit"] = $limit;

            $store_query->limit($limit);
            if ($page > 1) {
                $offset = $limit * ($page - 1);
                $store_query->offset($offset);
            }

            $store_res = $store_query->get()->toArray();

            foreach ($store_res as $k => $v) {
                $store_data = array();
                $store_data["name"] = $v["name"];
                $store_data["postal_code"] = $v["zipcode"];
                $store_data["address"] = config('common.pref')[$v['pref_id']]."　".$v['address'];
                $store_data["tel"] = $v["tel"];
                $store_data["product_line"]["arouge"] = $v['bland_arouge'] == 1 ? true : false;
                $store_data["product_line"]["enrich"] = $v['bland_enrich'] == 1 ? true : false;

                $data['data'][] = $store_data;
            }
        }

        return $this->resConversionJson($data);
    }

    public function geleerich_city()
    {
        $data = array();
        $pref_id = request('pref');
        if (!empty($pref_id)) {
            $city = config('citycode.code')[$pref_id];
            foreach ($city as $k => $v) {

                $store_query = Store::where('address', 'LIKE', "%$v%")->where('view_status', '=', 1)->where('status', '=', 1);
                if ($store_query->count() > 0) {
                    $city_data = array();
                    $city_data["code"] = $k;
                    $city_data["label"] = $v;

                    $data['data'][] = $city_data;
                }
            }
        }
        return response($this->resConversionJson($data));
    }

    public function geleerich_search()
    {
        $data = array();
        $city_id = request('city');
        $keyword = request('keyword');

        $store_query = Store::where('view_status', '=', 1)->where('status', '=', 1);
        if(!empty($city_id)) {
            $city_data = array();
            foreach (config('citycode.code') as $k => $v) {
                foreach ($v as $k2 => $v2) {
                    $city_data[$k2] = $v2;
                }
            }
            $address = $city_data[$city_id];

            $store_query->where('address', 'LIKE', "%$address%");
        }
        if(!empty($keyword)) {
            $store_query->where(function($q2) use($keyword) {
                    $q2->orWhere('name', 'LIKE', "%$keyword%");
                    $q2->orWhere('zipcode', 'LIKE', "%$keyword%");
                    $q2->orWhere('address', 'LIKE', "%$keyword%");
            });
        }

        if ($store_query->count() > 0) {
            $data["meta"]["total"] = $store_query->count();
            $data["meta"]["limit"] = 10;

            $store_res = $store_query->get()->toArray();

            foreach ($store_res as $k => $v) {
                $store_data = array();
                $store_data["name"] = $v["name"];
                $store_data["postal_code"] = $v["zipcode"];
                $store_data["address"] = config('common.pref')[$v['pref_id']]."　".$v['address'];
                $store_data["tel"] = $v["tel"];
                $store_data["product_line"]["arouge"] = $v['bland_arouge'] == 1 ? true : false;
                $store_data["product_line"]["enrich"] = $v['bland_enrich'] == 1 ? true : false;

                $data['data'][] = $store_data;
            }
        }

        return response($this->resConversionJson($data));
    }


    private function resConversionJson($result, $statusCode=200)
    {
        if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }

}
