<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\ZipcodeRule;
use App\Rules\PhoneRule;

class SampleFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();

        $rule = array();
        $rule['question.*'] = ['required'];
        $rule['txtName_1'] = ['required', 'max:50'];
        $rule['txtName_2'] = ['required', 'max:50'];
        $rule['txtName_12'] = ['required', 'max:100', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'];
        $rule['txtName_22'] = ['required', 'max:100', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'];
        $rule['zipcode'] = ['required', new ZipcodeRule()];
        $rule['txtKenmei'] = ['required'];
        $rule['txtCity'] = ['required', 'max:100'];
        $rule['txtTown'] = ['required', 'max:100'];
        //$rule['txtTown2'] = ['required', 'max:100'];
        $rule['USR_SEX'] = ['required'];
        $rule['tel'] = ['required', new PhoneRule()];
        $rule['birthday'] = ['required', 'date'];

        return $rule;
    }

    public function messages()
    {
        $messages = array();

        $messages['question.*.required'] = '設問を選択してください。';

        $messages['txtName_1.required'] = 'お名前(姓)を入力してください。';
        $messages['txtName_1.max'] = 'お名前(姓)は50文字以内で入力してください。';

        $messages['txtName_2.required'] = 'お名前(名)を入力してください。';
        $messages['txtName_2.max'] = 'お名前(名)は50文字以内で入力してください。';

        $messages['txtName_12.required'] = 'フリガナ(姓)を入力してください。';
        $messages['txtName_12.max'] = 'フリガナ(姓)は100文字以内で入力してください。';
        $messages['txtName_12.regex'] = 'フリガナ(姓)はカタカナで入力してください。';

        $messages['txtName_22.required'] = 'フリガナ(名)を入力してください。';
        $messages['txtName_22.max'] = 'フリガナ(名)は100文字以内で入力してください。';
        $messages['txtName_22.regex'] = 'フリガナ(名)はカタカナで入力してください。';

        $messages['zipcode.required'] = '郵便番号を入力してください。';
        $messages['zipcode.zipcode'] = '郵便番号を正しく入力してください。';

        $messages['txtKenmei.required'] = '都道府県名を選択してください。';

        $messages['txtCity.required'] = '市区町村を入力してください。';
        $messages['txtCity.max'] = '市区町村は100文字以内で入力してください。';

        $messages['txtTown.required'] = '番地を入力してください。';
        $messages['txtTown.max'] = '番地は100文字以内で入力してください。';

        //$messages['txtTown2.required'] = 'アパート、マンション、部屋番号を入力してください。';

        $messages['USR_SEX.required'] = '性別を選択してください。';

        $messages['tel.required'] = '電話番号を入力してください。';
        $messages['tel.phone'] = '電話番号を正しく入力してください。';

        $messages['birthday.required'] = '生年月日を選択してください。';
        $messages['birthday.date'] = '生年月日を正しく選択してください。';

        return $messages;
    }

    public function validationData()
    {
        $data = $this->all();
        foreach ($data["q_title"] as $k => $v) {
            $question = "question".$k;
            if (isset($data[$question])){
                $data['question'][$k] = $data[$question];
            } else {
                $data['question'][$k] = "";
            }
        }

        if (!empty($data["txtName_12"])) {
            $data['txtName_12'] = mb_convert_kana(mb_convert_kana($data['txtName_12'], 'KV', 'UTF-8'), 'C', 'UTF-8');
        }
        if (!empty($data["txtName_22"])) {
            $data['txtName_22'] = mb_convert_kana(mb_convert_kana($data['txtName_22'], 'KV', 'UTF-8'), 'C', 'UTF-8');
        }

        $zipcode = "";
        if (!empty($data['txtPono_1']) && !empty($data['txtPono_2'])) {
            $zipcode = $data['txtPono_1']."-".$data['txtPono_2'];
        }
        $data['zipcode'] = $zipcode;

        $tel = "";
        if (!empty($data['txtTel_1']) && !empty($data['txtTel_2']) && !empty($data['txtTel_3'])) {
            $tel = $data['txtTel_1']."-".$data['txtTel_2']."-".$data['txtTel_3'];
        }
        $data['tel'] = $tel;

        $birthday = "";
        if (!empty($data['seireki']) && !empty($data['tuki']) && !empty($data['day'])) {
            $birthday = $data['seireki']."-".$data['tuki']."-".$data['day'];
        }
        $data['birthday'] = $birthday;

        return $data;
    }
}
