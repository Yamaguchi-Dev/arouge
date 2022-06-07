<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Form;
use App\Models\Question;
use App\Models\Choice;
use App\Models\AnswerUser;
use App\Models\AnswersChoice;
use App\Http\Requests\SampleFormRequest;

use App\Mail\CampaignAdminMail;
use App\Mail\CampaignUserMail;

use Illuminate\Support\Facades\Crypt;

class SampleController extends Controller
{
    //
    public function input($id = null)
    {
        if (empty($id)) return redirect('https://'.$_SERVER['HTTP_HOST']);
        $now = date('Y-m-d H:i:s');

        $query = Form::with(['question', 'question.choice'])
        ->where('forms.status', '=', 1)
        ->where('forms.view_status', '=', 1)
        ->where('forms.open_start', '<=', $now)
        ->where('forms.open_end', '>=', $now)
        ->where('forms.apply_start', '<=', $now)
        ->where('forms.apply_end', '>=', $now)
        ->where('id', '=', $id);

        if ($query->count() < 1) return redirect('https://'.$_SERVER['HTTP_HOST']);

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

        $max_select_year = date('Y') - 3;
        $include_file = "favor.form".$id;

        return view('sample.input', compact("data", "max_select_year", "include_file"));
    }

    public function comfirm(SampleFormRequest $request)
    {
        $request = new SampleFormRequest($request->all());
        $data = $request->query();

        $q_query = Question::where('questions.forms_id', '=', $data['id'])->where('questions.status', '=', 1);
        $q_res = $q_query->get()->toArray();

        // 文字整形
        $data["txtName_12"] = mb_convert_kana(mb_convert_kana($data["txtName_12"], 'KV', 'UTF-8'), 'C', 'UTF-8');
        $data["txtName_22"] = mb_convert_kana(mb_convert_kana($data["txtName_22"], 'KV', 'UTF-8'), 'C', 'UTF-8');

        $q_data = array();
        foreach ($q_res as $k => $v) {
            $q_arr = $v;
            $choice = Choice::where('questions_id', '=', $v['id'])->where('status', '=', 1)->get()->toArray();
            $q_arr['choice'] = $choice;
            $q_data[] = $q_arr;
        }
        foreach ($q_data as $k => $v) {
            $q_arr = array();
            $question = "question".($k+1);
            $q_arr['q_title'] = $v['title'];

            if (is_array($data[$question])) {
                $a_arr = array();
                foreach ($data[$question] as $k2 => $v2) {
                    $a_arr[] = $v['choice'][$v2 - 1]['contents'];
                }
                $q_arr['answer'] = implode(",", $a_arr);
            } else {
                $q_arr['answer'] = $v['choice'][$data[$question] - 1]['contents'];
            }

            $data['question'][] = $q_arr;
        }

        Session::put('_token', $data["_token"]);

        return view('sample.confirm', compact("data"));
    }

    public function regist(SampleFormRequest $request)
    {
        $request = new SampleFormRequest($request->all());
        $data = $request->query();
        $q_data = Question::where('forms_id', '=', $data['id'])->where('status', '=', 1)->get()->toArray();


        $post_token = "dummy_post_token";
        if (isset($data["_token"])) $post_token = $data["_token"];
        $sess_token = "dummy_sess_token";
        if (Session::has('_token')) $sess_token = Session::get('_token');

        Session::forget('_token');

        if ($sess_token != $post_token) {
            return redirect(route('sample_input').'/'.$data["id"]);
        } else {
            // 登録
            $answer_user = new AnswerUser();

            $answer_user->forms_id = $data['id'];
            $answer_user->name = Crypt::encrypt($data['txtName_1']." ".$data['txtName_2']);
            $answer_user->kana = Crypt::encrypt($data['txtName_12']." ".$data['txtName_22']);
            $answer_user->zipcode = Crypt::encrypt($data['txtPono_1']."-".$data['txtPono_2']);
            $answer_user->pref_id = $data['txtKenmei'];
            $answer_user->address = Crypt::encrypt($data['txtCity'].$data['txtTown'].$data['txtTown2']);
            $answer_user->tel = Crypt::encrypt($data['txtTel_1']."-".$data['txtTel_2']."-".$data['txtTel_3']);
            $answer_user->email = Crypt::encrypt($data['txtEmail']);
            $answer_user->gender_id = $data['USR_SEX'];
            $answer_user->birthday = Crypt::encrypt($data['seireki']."-".$data['tuki']."-".$data['day']);
            $answer_user->status = 1;

            $answer_user->save();
            $insertId = $answer_user->id;

            foreach ($q_data as $k => $v) {
                $question = "question".($k+1);

                if (is_array($data[$question])) {
                    foreach ($data[$question] as $k2 => $v2) {
                        $choice_query = Choice::where('questions_id', '=', $v['id'])->where('choice_no', '=', $v2)->where('status', '=', 1);
                        if ($choice_res = $choice_query->get()->toArray()) {
                            $choice_data = $choice_res[0];

                            $answer_choice = new AnswersChoice();

                            $answer_choice->questions_id = $v['id'];
                            $answer_choice->answer_users_id  = $insertId;
                            $answer_choice->choices_id  = $choice_data['id'];
                            $answer_choice->status = 1;
                            $answer_choice->save();
                        }
                    }
                } else {
                    // 選択肢情報取得
                    $choice_query = Choice::where('questions_id', '=', $v['id'])->where('choice_no', '=', $data[$question])->where('status', '=', 1);
                    if ($choice_res = $choice_query->get()->toArray()) {
                        $choice_data = $choice_res[0];

                        $answer_choice = new AnswersChoice();

                        $answer_choice->questions_id = $v['id'];
                        $answer_choice->answer_users_id  = $insertId;
                        $answer_choice->choices_id  = $choice_data['id'];
                        $answer_choice->status = 1;
                        $answer_choice->save();
                    }
                }
            }
        }

        $this->send_user_mail($data, $q_data);
        $this->send_admin_mail($data, $q_data);
        Session::put('sample_input_data', $data);
        return redirect(route('sample_complete'));
    }

    public function complete()
    {
        if (!Session::has('sample_input_data')) {
            return redirect('/');
        }
        $data = Session::get('sample_input_data');

        $query = Form::where('id', '=', $data['id'])->get()->first();
        $complete_page = $query->complete_page;

        Session::forget('sample_input_data');
        return view('sample.complete', compact("data", "complete_page"));
    }

    function send_user_mail($data, $q_data) {
        Mail::to($data['txtEmail'])->send(new CampaignAdminMail('emails.campaign_admin', $data, $q_data));
    }

    function send_admin_mail($data, $q_data) {
        Mail::to('kei.yamaguchi.0104@gmail.com')->send(new CampaignUserMail('emails.campaign_user', $data, $q_data));
    }

}
