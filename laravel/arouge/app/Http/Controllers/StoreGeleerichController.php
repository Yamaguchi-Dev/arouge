<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class StoreGeleerichController extends Controller
{
    //
    public function list()
    {
        $search = array();
        $data = array();
        $title = "ジュレリッチ取扱店一覧";

        return view('admin.store_geleerich.list', compact('title', 'data', "search"));
    }

    public function input()
    {
    }

    public function confirm()
    {
    }

    public function regist()
    {
    }

    public function complete()
    {
    }

    public function csv_input()
    {
        $errors = array();
        if (Session::has('errors')) {
            $errors = Session::get('errors');
            Session::forget('errors');
        }

        $title = "ジュレリッチ取扱店CSVアップロード";
        return view('admin.store_geleerich.csv_input', compact('errors', 'title'));
    }

    public function csv_upload()
    {
    }

    public function csv_complete()
    {
    }

    public function view_change()
    {
    }

    public function delete()
    {
    }

    public function delete_search()
    {
    }

    public function delete_confirm()
    {
    }

    public function delete_done()
    {
    }
}
