<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\FormUser;
use App\Models\Form;
use App\Models\Question;
use App\Models\Choice;
use App\Models\AnswerUser;
use App\Http\Requests\CampaignFormRequest;
use App\Http\Requests\SearchRequest;
use Func;

use Illuminate\Support\Facades\Crypt;

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
        return view('admin.form.login');
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

    public function list(SearchRequest $search_req)
    {
        $search_arr = array();
        $search_arr = Func::getSearch($search_req, 'form_list');
        $search = new SearchRequest($search_arr);

        $query = Form::with(['question', 'question.choice', 'answer_user'])
        ->where('forms.status', '=', 1);

        if (!empty($search->id)) {
            $query->where('forms.id', '=', $search->id);
        }

        if (!empty($search->view_status)) {
            $query->where('forms.view_status', '=', $search->view_status);
        }

        if (!empty($search->admin_title)) {
            $query->where('forms.admin_title', 'LIKE', "%$search->admin_title%");
        }

        if (!empty($search->search_start)) {
            $query->where('forms.open_start', '>=', $search->search_start);
        }

        if (!empty($search->search_end)) {
            $query->where('forms.open_end', '<=', $search->search_end);
        }


        $data = $query->paginate(10);

        // 管理タイトル検索用データ
        $form_query = Form::where('status', '=', 1);
        $form_data = $form_query->get()->toArray();

        $title = "アルージェキャンペーン一覧";
        return view('admin.form.list', compact("title", "data", "form_data", "search"));
    }

    public function preview($id = null)
    {
        if (empty($id)) return redirect(route('form_list'));

        $query = Form::with(['question', 'question.choice'])
        ->where('forms.status', '=', 1)
        ->where('id', '=', $id);

        $arr = $query->get()->toArray();
        $res = $arr[0];

        $data = $res;
        foreach ($res['question'] as $k => $v) {
            $data['q_title'][] = $v['title'];
            $data['type'][] = $v['type'];

            foreach ($v['choice'] as $k2 => $v2) {
                if ($v2['status'] == 1) {
                    $data['choice'][$k][] = $v2['contents'];
                }
            }
        }
        return view('admin.form.preview', compact("data"));
    }

    public function confirm_preview()
    {
        $data = Session::get('form_input_data');
        return view('admin.form.preview', compact("data"));
    }

    public function input($id = null)
    {
        $data = array();
        $no = 0;
        if (!empty($id)) {
            $form_query = Form::with(['question', 'question.choice'])->where('id', '=', $id);
            if ($form_query->count() > 0) {
                $form_data = $form_query->get()->toArray();
                $data = $form_data[0];
                foreach ($data['question'] as $k => $v) {
                    $data['q_title'][$k] = $v['title'];
                    $data['type'][$k] = $v['type'];
                    foreach ($v['choice'] as $k2 => $v2) {
                        if ($v2['status'] == 1) {
                            $data['choice'][$k][] = $v2['contents'];
                        }
                    }
                }
                $no = $data["id"];
            }
        }
        if (Session::has('form_input_data')) {
            $data = Session::get('form_input_data');
            //Session::forget('form_input_data');
        }
        if (\old()) {
            $data = \old();
        }

        if ($no < 1) {
            $no = 1;
            if (Form::orderBy('id', 'desc')->count() > 0) {
                $form_new_data = Form::orderBy('id', 'desc')->first();
                $no = $form_new_data->id + 1;
            }
        }

        $title = "アルージェキャンペーン新規追加";
        return view('admin.form.input', compact("title", "data", "no"));
    }

    public function confirm(CampaignFormRequest $request)
    {
        $request = new CampaignFormRequest($request->all());
        $data = $request->except('_token');
        $mode_url = route('form_confirm_preview');

        if (!empty($data["mode"])) {
            $mode = $data["mode"];
            $mode_url = route($mode);
        }
        Session::put('form_input_data', $data);

        return view('admin.form.confirm', compact("data", "mode_url"));
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

        if (!empty($data['id'])) {
            $form = $form->find($data['id']);
        }

        $form->form_users_id = $user_data['id'];
        $form->title = $data['title'];
        $form->admin_title = $data['admin_title'];
        $form->contents = $data['contents'];
        $form->open_start = $data['open_start'];
        $form->open_end = $data['open_end'];
        $form->apply_start = $data['apply_start'];
        $form->apply_end = $data['apply_end'];
        $form->summary = $data['summary'];
        $form->complete_page = $data['complete'];
        $form->view_status = $data['view_status'];
        $form->status = 1;
        $form->save();
        $insertId = $form->id;

        // 設問登録
        if (!empty($data['id'])) {
            Question::where('forms_id', '=', $data['id'])->update(["status" => 2]);
        }
        foreach ($question as $k => $v) {
            $question = new Question();

            if (!empty($data['id'])) {
                $question_query = Question::where('forms_id', '=', $data['id'])->where('no', '=', $k + 1);
                if ($question_query->count() > 0) {
                    $question_data = $question_query->get()->first();
                    $question = $question->find($question_data->id);
                }
            }

            $question->forms_id = $insertId;
            $question->no = $k + 1;
            $question->type = $v['type'];
            $question->title = $v['q_title'];
            $question->status = 1;
            $question->save();
            $questionId = $question->id;

            if (!empty($data['id'])) {
                Choice::where('questions_id', '=', $questionId)->update(["status" => 2]);
            }
            foreach ($v['choice'] as $k2 => $v2) {
                $choice = new Choice();

                $choice->questions_id  = $questionId;
                $choice->choice_no = $k2 + 1;
                $choice->contents = $v2;
                $choice->status = 1;
                $choice->save();
            }
        }

        // ファイル作成
        if (empty($data['id'])) {
            $file_name = dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'favor'.DIRECTORY_SEPARATOR.'form'.$insertId.'.blade.php';
            file_put_contents($file_name, "");
        }

        session()->flash('status', '保存が完了しました');
        return redirect(route('form_edit')."/".$insertId);
    }

    public function complete()
    {
        Session::forget('form_input_data');
        return view('admin.form.complete');
    }

    public function edit($id = null)
    {
        $data = array();
        $no = 0;
        if (!empty($id)) {
            $form_query = Form::with(['question', 'question.choice'])->where('id', '=', $id);
            if ($form_query->count() > 0) {
                $form_data = $form_query->get()->toArray();
                $data = $form_data[0];
                $data['complete'] = $data['complete_page'];
                foreach ($data['question'] as $k => $v) {
                    $data['q_title'][$k] = $v['title'];
                    $data['type'][$k] = $v['type'];
                    foreach ($v['choice'] as $k2 => $v2) {
                        if ($v2['status'] == 1) {
                            $data['choice'][$k][] = $v2['contents'];
                        }
                    }
                }
                $no = $data["id"];
            }
        }
        if (Session::has('form_input_data')) {
            $data = Session::get('form_input_data');
            //Session::forget('form_input_data');
        }
        if (\old()) {
            $data = \old();
        }

        if ($no < 1) {
            $no = 1;
            if (Form::orderBy('id', 'desc')->count() > 0) {
                $form_new_data = Form::orderBy('id', 'desc')->first();
                $no = $form_new_data->id + 1;
            }
        }

        $title = "アルージェキャンペーン編集";
        return view('admin.form.edit', compact("title", "data", "no"));
    }

    public function update(CampaignFormRequest $request)
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

        if (!empty($data['id'])) {
            $form = $form->find($data['id']);
        }

        $form->form_users_id = $user_data['id'];
        $form->title = $data['title'];
        $form->admin_title = $data['admin_title'];
        $form->contents = $data['contents'];
        $form->open_start = $data['open_start'];
        $form->open_end = $data['open_end'];
        $form->apply_start = $data['apply_start'];
        $form->apply_end = $data['apply_end'];
        $form->summary = $data['summary'];
        $form->complete_page = $data['complete'];
        $form->view_status = $data['view_status'];
        $form->status = 1;
        $form->save();
        $insertId = $form->id;

        // 設問登録
        if (!empty($data['id'])) {
            Question::where('forms_id', '=', $data['id'])->update(["status" => 2]);
        }
        foreach ($question as $k => $v) {
            $question = new Question();

            if (!empty($data['id'])) {
                $question_query = Question::where('forms_id', '=', $data['id'])->where('no', '=', $k + 1);
                if ($question_query->count() > 0) {
                    $question_data = $question_query->get()->first();
                    $question = $question->find($question_data->id);
                }
            }

            $question->forms_id = $insertId;
            $question->no = $k + 1;
            $question->type = $v['type'];
            $question->title = $v['q_title'];
            $question->status = 1;
            $question->save();
            $questionId = $question->id;

            if (!empty($data['id'])) {
                Choice::where('questions_id', '=', $questionId)->update(["status" => 2]);
            }
            foreach ($v['choice'] as $k2 => $v2) {
                $choice = new Choice();

                $choice->questions_id  = $questionId;
                $choice->choice_no = $k2 + 1;
                $choice->contents = $v2;
                $choice->status = 1;
                $choice->save();
            }
        }

        Session::put('form_input_data', $data);
        session()->flash('status', '保存が完了しました');
        return redirect(route('form_edit')."/".$insertId);
    }

    public function edit_complete()
    {

        $data = Session::get('form_input_data');
        Session::forget('form_input_data');
        $no = $data["id"];
        session()->flash('status', '保存が完了しました');

        $title = "アルージェキャンペーン編集";
        return view('admin.form.edit', compact("title", "data", "no"));
    }

    public function delete($id = null)
    {
        $form = new Form();

        $form = $form->find($id);
        $form->status = 2;
        $form->save();

        session()->flash('status', '削除が完了しました');

        return redirect(route('form_list'));
    }


    public function search(SearchRequest $search_req)
    {
        $search_arr = array();
        $search_arr = Func::getSearch($search_req, 'form_search');
        $search = new SearchRequest($search_arr);

        $query = Form::with(['question', 'question.choice', 'answer_user'])
        ->where('forms.status', '=', 1);

        if (!empty($search->id)) {
            $query->where('forms.id', '=', $search->id);
        }

        if (!empty($search->view_status)) {
            $query->where('forms.view_status', '=', $search->view_status);
        }

        if (!empty($search->admin_title)) {
            $query->where('forms.admin_title', 'LIKE', "%$search->admin_title%");
        }

        if (!empty($search->search_start)) {
            $query->where('forms.open_start', '>=', $search->search_start);
        }

        if (!empty($search->search_end)) {
            $query->where('forms.open_end', '<=', $search->search_end);
        }

        $data = $query->paginate(10);

        // 管理タイトル検索用データ
        $form_query = Form::where('status', '=', 1);
        $form_data = $form_query->get()->toArray();

        $title = "アルージェ応募者情報一覧";
        return view('admin.form.search', compact("title", "data", "form_data", "search"));
    }

    public function detail($form_id = null)
    {
        if (empty($form_id)) return redirect(route('form_list'));

        $form_query = Form::with(['question'])->where('forms.id', '=', $form_id)->where('forms.status', '=', 1);
        $form_data = $form_query->get()->first();

        $query = AnswerUser::with(['answer_choice', 'answer_choice.question', 'answer_choice.choice']);
        $query->where('answer_users.forms_id', '=', $form_id);

        //$data = $query->get()->toArray();
        $data = $query->paginate(10);

        $user_data = array();
        foreach ($data as $k => $v) {
            $arr = array();
            $arr['created'] = $v->created_at;
            $arr['id'] = $v->id;
            $arr['name'] = Crypt::decrypt($v->name);
            $arr['kana'] = Crypt::decrypt($v->kana);
            $arr['zipcode'] = Crypt::decrypt($v->zipcode);
            $arr['address'] = config('common.pref')[$v->pref_id].Crypt::decrypt($v->address);
            $arr['tel'] = Crypt::decrypt($v->tel);
            $arr['email'] = "";
            if (!empty($v["email"])) {
                $arr['email'] = Crypt::decrypt($v["email"]);
            }

            $gender = "回答なし";
            if($v->gender_id == 1) {
                $gender = "男性";
            } elseif ($v->gender_id == 2) {
                $gender = "女性";
            }
            $arr['gender'] = $gender;

            $arr['birthday'] = Crypt::decrypt($v->birthday);

            $answer = array();
            foreach ($v->answer_choice as $k2 => $v2) {
                $choice = $v2->choice;
                $answer[$v2->question->no][] = $choice->contents;
            }
            $arr['answer_choice'] = $answer;

            $user_data[] = $arr;
        }

        $title = "アルージェ応募者情報一覧";
        return view('admin.form.detail', compact("title", "form_data", "data", "user_data"));
    }

    public function input_preview()
    {
        $data = Session::get('form_input_data');
        return view('admin.form.preview', compact("data"));
    }

    public function complete_preview($id = null)
    {
        $data = array();
        if (!empty($id)) {
            $query = Form::with(['question', 'question.choice'])
            ->where('forms.status', '=', 1)
            ->where('id', '=', $id);

            $arr = $query->get()->toArray();
            $data = $arr[0];
            $data['complete'] = $data['complete_page'];
        } elseif (Session::has('form_input_data')) {
            $data = Session::get('form_input_data');
        }
        return view('admin.form.complete_preview', compact("data"));
    }

    public function csv_download(SearchRequest $search_req)
    {
        $search_arr = array();
        $search = new SearchRequest($search_req->all());

        $file_name = "arouge_sample_".date('YmdHis').".csv";
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

            $form_query = Form::with(['question'])->where('forms.id', '=', $search->id)->where('forms.status', '=', 1);
            $form_data = $form_query->get()->first();

            $query = AnswerUser::with(['answer_choice', 'answer_choice.question', 'answer_choice.choice']);
            if (!empty($search->csv_start)) {
                $query->where('answer_users.created_at', '>=', $search->csv_start);
            }

            if (!empty($search->csv_end)) {
                $query->where('answer_users.created_at', '<=', $search->csv_end);
            }
            $query->where('answer_users.forms_id', '=', $search->id);

            $data = $query->get()->toArray();

            $user_data = array();
            foreach ($data as $k => $v) {
                $arr = array();
                $arr['created'] = $v["created_at"];
                $arr['id'] = $v["id"];
                $arr['name'] = Crypt::decrypt($v["name"]);
                $arr['kana'] = Crypt::decrypt($v["kana"]);
                $arr['zipcode'] = Crypt::decrypt($v["zipcode"]);
                $arr['address'] = config('common.pref')[$v["pref_id"]].Crypt::decrypt($v["address"]);
                $arr['tel'] = Crypt::decrypt($v["tel"]);
                $arr['email'] = "";
                if (!empty($v["email"])) {
                    $arr['email'] = Crypt::decrypt($v["email"]);
                }

                $gender = "回答なし";
                if($v["gender_id"] == 1) {
                    $gender = "男性";
                } elseif ($v["gender_id"] == 2) {
                    $gender = "女性";
                }
                $arr['gender'] = $gender;

                $arr['birthday'] = Crypt::decrypt($v["birthday"]);

                $answer = array();
                foreach ($v["answer_choice"] as $k2 => $v2) {
                    $choice = $v2["choice"];
                    $answer[$v2["question"]["no"]][] = $choice["contents"];
                }
                $arr['answer_choice'] = $answer;

                $user_data[] = $arr;
            }

            $columns = [ //1行目の情報
                '応募日時',
                '番号',
                'お名前',
                'フリガナ',
                '郵便番号',
                '住所',
                '電話番号',
                'email',
                '性別',
                '生年月日',
            ];
            foreach ($form_data->question as $k => $v) {
                $columns[] = "Q".$v->no;
            }
            mb_convert_variables('SJIS-win', 'UTF-8', $columns); //文字化け対策
            fputcsv($createCsvFile, $columns); //1行目の情報を追記

            foreach ($user_data as $k => $v) {
                $csv = [
                    date("Y.m.d H:i", strtotime($v["created"])),
                    $v["id"],
                    $v["name"],
                    $v["kana"],
                    $v["zipcode"],
                    $v["address"],
                    $v["tel"],
                    $v["email"],
                    $v["gender"],
                    date("Y年m月d日", strtotime($v["birthday"])),
                ];

                foreach($form_data->question as $k2 => $v2) {
                    if(empty($v['answer_choice'][$v2->no])) {
                        $csv[] = "";
                    } else {
                        $csv[] = implode(", ", $v['answer_choice'][$v2->no]);
                    }
                }

                mb_convert_variables('SJIS-win', 'UTF-8', $csv); //文字化け対策
                fputcsv($createCsvFile, $csv); //ファイルに追記する
            }

            fclose($createCsvFile); //ファイル閉じる
        };

        return response()->stream($callback, 200, $headers); //ここで実行
    }
}
