<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\FormUser;
use App\Models\Form;
use App\Models\Question;
use App\Models\Choice;
use App\Http\Requests\CampaignFormRequest;

class FormController extends Controller
{
    protected $user_data;
    //
    public function __construct()
    {
        $this_page = \Route::currentRouteName();

        $this->user_data = Session::get('form_user_data');
        if ($this_page != "form" && $this_page != "form_login" && $this_page != "form_login_auth") {
            if (empty($this->user_data)) {
                Redirect::to(route('form_login'))->send();
                exit;
            }
        } else {
            if (!empty($this->user_data)) {
                Redirect::to(route('form_list'))->send();
                exit;
            }
        }
    }

    public function index()
    {
        return redirect(route('form_login'));
    }

    public function login()
    {
        return view('form.login');
    }

    public function login_auth(Request $request)
    {
        $request = new Request($request->all());
        $data = $request->except('_token');

        $password = md5($data['password']);

        $query = FormUser::where('status', '=', 1);
        $query = $query->where('login_id', '=', $data['id']);
        $query = $query->where('password', '=', $password);

        if(!($res = $query->get()->first())) {
            session()->flash('status', 'ログイン情報が間違っています');
            return redirect()->route("form_login")->withInput($data);
        }

        $user = array();
        $user["id"] = $res->id;
        $user["login_id"] = $res->login_id;
        $user["password"] = $res->password;
        $user["email"] = $res->email;
        $user["name"] = $res->name;

        Session::put('form_user_data', $user);

        return redirect(route('form_list'));
    }

    public function logout()
    {
        return redirect(route('form_login'));
    }

    public function list()
    {
        $title = "アルージェキャンペーン一覧";
        return view('form.list', compact("title"));
    }

    public function preview()
    {
        $data = Session::get('form_input_data');
        return view('form.preview', compact("data"));
    }

    public function input()
    {
        $data = array();
        if (Session::has('form_input_data')) {
            $data = Session::get('form_input_data');
            //Session::forget('form_input_data');
        }

        $form_new_data = Form::orderBy('id', 'desc')->first();
        $no = $form_new_data->id + 1;

        $title = "アルージェキャンペーン新規追加";
        return view('form.input', compact("title", "data", "no"));
    }

    public function confirm(CampaignFormRequest $request)
    {
        $request = new CampaignFormRequest($request->all());
        $data = $request->except('_token');

        Session::put('form_input_data', $data);

        return view('form.confirm', compact("data"));
    }

    public function regist(CampaignFormRequest $request)
    {
        $request = new CampaignFormRequest($request->all());
        $data = $request->except('_token');

        $question = array();
        foreach ($data['q_title'] as $k => $v) {
            $q_contents = array();
            $q_contents['q_title'] = $v;
            $q_contents['choice'] = $data['choice'][$k];
            $q_contents['type'] = $data['type'][$k];

            $question[] = $q_contents;
        }

        $user_data = $this->user_data;

        // 応募フォームへ登録
        $form = new Form();

        $form->form_users_id = $user_data['id'];
        $form->title = $data['title'];
        $form->admin_title = $data['admin_title'];
        $form->contents = $data['contents'];
        $form->open_start = $data['open_start'];
        $form->open_end = $data['open_end'];
        $form->apply_start = $data['apply_start'];
        $form->apply_end = $data['apply_end'];
        $form->view_status = $data['view_status'];
        $form->status = 1;
        $form->save();
        $insertId = $form->id;

        // 設問登録
        foreach ($question as $k => $v) {
            $question = new Question();

            $question->forms_id = $insertId;
            $question->no = $k + 1;
            $question->type = $v['type'];
            $question->title = $v['q_title'];
            $question->status = 1;
            $question->save();
            $questionId = $question->id;

            foreach ($v['choice'] as $k2 => $v2) {
                $choice = new Choice();

                $choice->questions_id  = $questionId;
                $choice->choice_no = $k2 + 1;
                $choice->contents = $v2;
                $choice->status = 1;
                $choice->save();
            }
        }

        return redirect(route('form_complete'));
    }

    public function complete()
    {
        Session::forget('form_input_data');
        return view('form.complete');
    }

    public function search()
    {
        $title = "アルージェ応募者情報一覧";
        return view('form.search', compact("title"));
    }

    public function csv_download()
    {
    }
}
