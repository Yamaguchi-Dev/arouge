<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Store;


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

    public function list(Request $search)
    {
        return view('store.list');
    }

    public function input()
    {
        return view('store.input');
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
        return view('store.csv_input');
    }

    public function csv_upload(Request $request)
    {
        $file_path = $request->file('file_csv')->path();

        $file_content = new \SplFileObject($file_path);

        $file_content->setFlags(
            \SplFileObject::READ_CSV | // CSVとして行を読み込み
            \SplFileObject::READ_AHEAD | // 先読み／巻き戻しで読み込み
            \SplFileObject::SKIP_EMPTY | // 空行を読み飛ばす
            \SplFileObject::DROP_NEW_LINE // 行末の改行を読み飛ばす
        );

        $contents_data = array();
        // 文字化け対応
        foreach($file_content as $line)
        {
            $ar_l = array();
            foreach ($line as $l) {
                $ar_l[] = mb_convert_encoding($l, 'UTF-8', 'SJIS');
            }
            $contents_data[] = $ar_l;
        }
dd($contents_data);
    }

    public function csv_complete()
    {
    }

    public function view_change()
    {
    }

    public function delete()
    {
        return view('store.delete_search');
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
