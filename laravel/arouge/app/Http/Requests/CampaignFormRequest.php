<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignFormRequest extends FormRequest
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
        $rule['view_status'] = ['required'];
        $rule['open_start'] = ['required', 'date_format:"Y-m-d H:i"', 'before:open_end'];
        $rule['open_end'] = ['required', 'date_format:"Y-m-d H:i"', 'after:open_start'];
        $rule['admin_title'] = ['required', 'max:200'];
        $rule['title'] = ['required', 'max:200'];
        $rule['contents'] = ['required', 'max:300'];
        $rule['apply_start'] = ['required', 'date_format:"Y-m-d"', 'before:apply_end'];
        $rule['apply_end'] = ['required', 'date_format:"Y-m-d"', 'after:apply_start'];
        $rule['q_title.*'] = ['required', 'max:200'];
        $rule['choice.*.*'] = ['required', 'max:200'];
        $rule['type.*'] = ['required'];

        return $rule;
    }

    public function messages()
    {
        $messages = array();

        $messages['view_status.required'] = '公開・非公開を選択してください。';

        $messages['open_start.required'] = '公開開始日時を入力してください。';
        $messages['open_start.date_format'] = '公開開始日時を正しく入力してください。';
        $messages['open_start.before'] = '公開開始日時は公開終了日時より前に設定してください。';

        $messages['open_end.required'] = '公開終了日時を入力してください。';
        $messages['open_end.date_format'] = '公開終了日時を正しく入力してください。';
        $messages['open_end.after'] = '公開終了日時は公開開始日時より後に設定してください。';

        $messages['admin_title.required'] = '管理用タイトルを入力してください。';
        $messages['admin_title.max'] = '管理用タイトルは200文字以内で入力してください。';

        $messages['title.required'] = '掲載タイトルを入力してください。';
        $messages['title.max'] = '掲載タイトルは200文字以内で入力してください。';

        $messages['contents.required'] = '内容を入力してください。';
        $messages['contents.max'] = '内容は300文字以内で入力してください。';

        $messages['apply_start.required'] = '応募期間(開始)を入力してください。';
        $messages['apply_start.date_format'] = '応募期間(開始)を正しく入力してください。';
        $messages['apply_start.before'] = '応募期間(開始)は応募期間(終了)より前に設定してください。';

        $messages['apply_end.required'] = '応募期間(終了)を入力してください。';
        $messages['apply_end.date_format'] = '応募期間(終了)を正しく入力してください。';
        $messages['apply_end.after'] = '応募期間(終了)は応募期間(開始)より後に設定してください。';

        $messages['q_title.*.required'] = '設問を入力してください。';
        $messages['q_title.*.max'] = '設問は200文字以内で入力してください。';

        $messages['choice.*.*.required'] = '選択肢を入力してください。';
        $messages['choice.*.*.max'] = '選択肢は200文字以内で入力してください。';

        $messages['type.*.required'] = '選択方法を選択してください。';

        return $messages;
    }

    public function validationData()
    {
        $data = $this->all();
        foreach ($data["q_title"] as $k => $v) {
            if (!isset($data['type'][$k])){
                $data['type'][$k] = "";
            }
        }
        return $data;
    }

}
