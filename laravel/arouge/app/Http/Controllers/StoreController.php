<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class StoreController extends Controller
{

    protected $user_data;
    //
    public function __construct()
    {
        $this_page = \Route::currentRouteName();

        $this->user_data = Session::get('store_user_data');
        if ($this_page != "store" && $this_page != "store_login" && $this_page != "store_login_auth") {
            if (empty($this->user_data)) {
                Redirect::to(route('store_login'))->send();
                exit;
            }
        } else {
            if (!empty($this->user_data)) {
                Redirect::to(route('store_list'))->send();
                exit;
            }
        }
    }

    public function index()
    {
        return redirect(route('store_login'));
    }

    public function login()
    {
        return view('store.login');
    }

    public function login_auth(Request $request)
    {
        $request = new Request($request->all());
        $data = $request->except('_token');

        $password = md5($data['password']);

        $query = User::where('status', '=', 1);
        $query = $query->where('login_id', '=', $data['id']);
        $query = $query->where('password', '=', $password);

        if(!($res = $query->get()->first())) {
            session()->flash('status', 'ログイン情報が間違っています');
            return redirect()->route("store_login")->withInput($data);
        }

        $user = array();
        $user["id"] = $res->login_id;
        $user["password"] = $res->password;
        $user["name"] = $res->name;

        Session::put('store_user_data', $user);

        return redirect(route('store_list'));
    }

    public function list()
    {
        return view('store.list');
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
