<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreRequest;
use App\Models\User;
use App\Models\Store;

use App\Mail\SampleMail;

use Func;

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
        return view('admin.store.login');
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
        $user["id"] = $res->id;
        $user["login_id"] = $res->login_id;
        $user["password"] = $res->password;
        $user["name"] = $res->name;

        Session::put('store_user_data', $user);

        return redirect(route('store_list'));
    }

    public function logout()
    {
        return redirect(route('store_login'));
    }

    public function list(SearchRequest $search_req)
    {
        $search_arr = array();
        $search_arr = Func::getSearch($search_req, 'store_search');
        $search = new SearchRequest($search_arr);

        $query = Store::where('status', '=', 1);

        if (!empty($search->name)) {
            $query->where('name', 'LIKE', "%$search->name%");
        }

        if (!empty($search->zipcode)) {
            $query->where('zipcode', 'LIKE', "%$search->zipcode%");
        }

        if (!empty($search->pref_id)) {
            $query->where('pref_id', '=', "$search->pref_id");
        }

        if (!empty($search->address)) {
            $query->where('address', 'LIKE', "%$search->address%");
        }

        if (!empty($search->tel)) {
            $query->where('tel', 'LIKE', "%$search->tel%");
        }

        if (!empty($search->bland)) {
            $query->where(function($q2) use($search) {
                if (in_array(1, $search->bland)) {
                    $q2->orWhere('bland_arouge', '=', "1");
                }
                if (in_array(2, $search->bland)) {
                    $q2->orWhere('bland_enrich', '=', "1");
                }
            });
        }

        $data = $query->paginate(10);

        $title = "アルージェ取扱店一覧";
        return view('admin.store.list', compact('title', 'data', "search"));
    }

    public function csv_download(SearchRequest $search_req)
    {
        $search_arr = array();
        $search_arr = Func::getSearch($search_req, 'store_search');
        $search = new SearchRequest($search_arr);

        $file_name = "arouge_store_".date('YmdHis').".csv";
        $headers = [ //ヘッダー情報
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename='.$file_name,
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use($search)
        {
            $createCsvFile = fopen('php://output', 'w'); //ファイル作成

            $query = Store::where('status', '=', 1);

            if (!empty($search->name)) {
                $query->where('name', 'LIKE', "%$search->name%");
            }

            if (!empty($search->zipcode)) {
                $query->where('zipcode', 'LIKE', "%$search->zipcode%");
            }

            if (!empty($search->pref_id)) {
                $query->where('pref_id', '=', "$search->pref_id");
            }

            if (!empty($search->address)) {
                $query->where('address', 'LIKE', "%$search->address%");
            }

            if (!empty($search->tel)) {
                $query->where('tel', 'LIKE', "%$search->tel%");
            }

            if (!empty($search->bland)) {
                $query->where(function($q2) use($search) {
                    if (in_array(1, $search->bland)) {
                        $q2->orWhere('bland_csv', 'LIKE', "%1%");
                    }
                    if (in_array(2, $search->bland)) {
                        $q2->orWhere('bland_csv', 'LIKE', "%2%");
                    }
                });
            }

            $data = $query->get()->toArray();

            $columns = [ //1行目の情報
                'ID',
                '口座コード',
                '支店コード',
                '電話番号',
                '郵便番号',
                '店舗名',
                '都道府県',
                '住所',
                'アルージェ取扱状況',
                'エンリッチ取扱状況',
            ];
            mb_convert_variables('SJIS-win', 'UTF-8', $columns); //文字化け対策
            fputcsv($createCsvFile, $columns); //1行目の情報を追記

            foreach ($data as $k => $v) {
                $bland_id = explode(",", $v["bland_csv"]);
                $bland = array();
                foreach ($bland_id as $k2 => $v2) {
                    $bland[] = $v2 == "1" ? "アルージェ" : "エンリッチ";
                }

                $csv = [
                    $v["id"],
                    $v["account_code"],
                    $v["branch_code"],
                    $v["tel"],
                    $v["zipcode"],
                    $v["name"],
                    $v["pref"],
                    $v["address"],
                    $v["bland_arouge"],
                    $v["bland_enrich"],
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv); //文字化け対策
                fputcsv($createCsvFile, $csv); //ファイルに追記する
            }

            fclose($createCsvFile); //ファイル閉じる
        };
        return response()->stream($callback, 200, $headers); //ここで実行
    }

    public function input()
    {
        $title = "アルージェ取扱店新規追加";
        return view('admin.store.input', compact('title'));
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

    public function edit($id = null)
    {

        $data = array();
        if (!empty($id)) {
            $store_query = Store::where("id", "=", $id);
            if ($store_query->count() > 0) {
                $store_data = $store_query->get()->toArray();
                $data = $store_data[0];
                $data['bland'] = explode(",", $data['bland_csv']);
            }
        }
        if (\old()) {
            $data = \old();
        }
        //$this->send_mail($data);

        return view('admin.store.edit', compact('data'));
    }

    public function update(StoreRequest $request)
    {
        $request = new StoreRequest($request->all());
        $data = $request->except('_token');

        $store = new Store();
        $store = $store->find($data['id']);

        $store->name = $data['name'];
        $store->zipcode = $data['zipcode'];
        $store->pref_id = $data['pref_id'];
        $store->address = $data['address'];
        $store->tel = $data['tel'];
        $store->bland_csv = implode(',', $data['bland']);

        $store->save();

        return redirect(route('store_edit_complete'));
    }

    public function edit_complete()
    {
        return view('admin.store.edit_complete');
    }


    public function csv_input()
    {
        $errors = array();
        if (Session::has('errors')) {
            $errors = Session::get('errors');
            Session::forget('errors');
        }
        $title = "アルージェ取扱店CSVアップロード";
        return view('admin.store.csv_input', compact('errors', 'title'));
    }

    public function csv_upload(Request $request)
    {
        $errors = array();
        if (empty($request->file('file_csv'))) {
            $errors[] = "ファイルが選択されていません";
            Session::put('errors', $errors);
            return redirect()->route("store_csv_input");
        }
        $file_path = $request->file('file_csv')->path();

        $pref = config('common.pref');

        $file_content = new \SplFileObject($file_path);

        $file_content->setFlags(
            \SplFileObject::READ_CSV | // CSVとして行を読み込み
            \SplFileObject::READ_AHEAD | // 先読み／巻き戻しで読み込み
            \SplFileObject::SKIP_EMPTY | // 空行を読み飛ばす
            \SplFileObject::DROP_NEW_LINE // 行末の改行を読み飛ばす
        );

        $contents_data = array();
        // 文字化け対応
        foreach($file_content as $line) {
            $ar_l = array();
            foreach ($line as $l) {
                $ar_l[] = mb_convert_encoding($l, 'UTF-8', 'SJIS-win');
            }
            $contents_data[] = $ar_l;
        }

        // 文字整形
        $data = array();
        foreach ($contents_data as $k => $v) {
            $contents = $v;
            if ($k > 0) {
                $contents[3] = trim($v[3]);
                //$contents[5] = $this->cng_unicode($v[5]);
            }
            $data[] = $contents;
        }

        // バリデーション
        $errors = array();
        foreach ($data as $k => $v) {
            if ($k == 0) continue;
            $row = $k + 1;

            // 店舗名
            if (empty($v[5])) {
                $errors[] = $row.'行目の店舗名が空欄です。';
            } elseif (mb_strlen($v[5]) > 100) {
                $errors[] = $row.'行目の店舗名は100文字以内で入力してください。';
            }

            // 郵便番号
            if (empty($v[4])) {
                $errors[] = $row.'行目の郵便番号が空欄です。';
            } elseif (!$this->chk_zipcode($v[4])) {
                $errors[] = $row.'行目の郵便番号を正しく入力してください。';
            }

            // 都道府県
            if (empty($v[6])) {
                $errors[] = $row.'行目の都道府県が空欄です。';
            } elseif (!in_array($v[6], config('common.pref'))) {
                $errors[] = $row.'行目の都道府県を正しく入力してください。';
            }

            // 住所
            if (empty($v[7])) {
                $errors[] = $row.'行目の住所が空欄です。';
            } elseif (mb_strlen($v[7]) > 200) {
                $errors[] = $row.'行目の住所は200文字以内で入力してください。';
            }

            // 電話番号
            if (empty($v[3])) {
                $errors[] = $row.'行目の電話番号が空欄です。';
            } elseif (!$this->chk_tel($v[3])) {
                $errors[] = $row.'行目の電話番号を正しく入力してください。';
            }

            // お取り扱い状況
            if ($v[8] != 1 && $v[8] != 0) {
                $errors[] = $row.'行目のアルージェ取扱状況は0か1のどちらかを入力してください。';
            }
            if ($v[9] != 1 && $v[9] != 0) {
                $errors[] = $row.'行目のエンリッチ取扱状況は0か1のどちらかを入力してください。';
            }
        }

        if (count($errors) > 0) {
            Session::put('errors', $errors);
            return redirect()->route("store_csv_input");
        }

        // 初期設定 全てのステータスを2にする
        Store::where('status', '=', 1)->update(["status" => 2]);

        $user_data = $this->user_data;
        // アップロード
        foreach ($data as $k => $v) {
            if ($k < 1) continue;

            $stores = new Store();
            if (!empty($v[0])) {
                $stores = $stores->find($v[0]);
            }
            $stores->users_id = $user_data['id'];

            $stores->account_code = $v[1];
            $stores->branch_code = $v[2];

            $stores->name = $v[5];
            $stores->zipcode = $v[4];

            $pref_id = array_keys($pref, $v[6]);
            $stores->pref_id = $pref_id[0];
            $stores->pref = $v[6];

            $stores->address = $v[7];
            $stores->tel = trim($v[3]);

            $stores->bland_arouge = $v[8];
            $stores->bland_enrich = $v[9];

            $stores->view_status = 1;
            $stores->status = 1;

            $stores->save();
        }
        session()->flash('status', 'アップロードしました');
        return redirect()->route("store_csv_input");
    }

    public function csv_complete()
    {
    }

    public function view_change($id = null)
    {
        if (empty($id)) return redirect(route('store_list'));

        // データチェック
        $query = Store::where('id', '=', $id);

        if ($query->count() < 1) {
            return redirect(route('store_list'));
        }

        $data = $query->get()->first();

        $view_status = 1;
        $view_text = '公開';
        if ($data->view_status == 1) {
            $view_status = 2;
            $view_text = '非公開';
        }

        $store = new Store();
        $store = $store->find($data->id);

        $store->view_status = $view_status;
        $store->save();

        session()->flash('status', $view_text);

        return redirect(route('store_list'));
    }

    public function delete()
    {
        $title = "アルージェ取扱店削除";
        return view('admin.store.delete_search', compact('title'));
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

    function send_mail($data) {
        Mail::to('kei.yamaguchi.0104@gmail.com')->send(new SampleMail('emails.test', $data));
    }

    function cng_unicode($value) {
        foreach (config('common.cng_unicode') as $k => $v) {
            $value = str_replace($k, $v, $value);
        }
        return $value;
    }

    function chk_zipcode($value) {
        if (empty($value)) return true;
        if (empty(str_replace("-", "", $value))) return true;
        $zip = explode("-", $value);
        if (count($zip) != 2) return false;
        $len1 = strlen($zip[0]);
        $len2 = strlen($zip[1]);
        if($len1 != 3 || $len2 != 4) return false;
        if(!preg_match('/^[0-9]{7}$/', $zip[0].$zip[1])) return false;

        return true;
    }

    function chk_tel($value) {
        if (empty($value)) return true;
        if (substr_count($value, "-") > 2) return false;
        if (empty(str_replace("-", "", $value))) return true;
        $tel_ary = explode("-", $value);
        $tel = "";
        foreach ($tel_ary as $v) {
            $tel .= $v;
        }
        $len = strlen($tel);

        if(!preg_match('/^[0-9]*$/', $tel)) return false;
        if($len > 15) return false;

        if(!isset($tel_ary[0]) || !strlen($tel_ary[0])) return false;
        if(!isset($tel_ary[1]) || !strlen($tel_ary[1])) return false;
        if(!isset($tel_ary[2]) || !strlen($tel_ary[2])) return false;

        if(preg_match('/^0[5789]0/', $tel) && $len != 11) return false;
        if(!preg_match('/^0[5789]0/', $tel) && $len != 10) return false;
        return true;
    }
}
