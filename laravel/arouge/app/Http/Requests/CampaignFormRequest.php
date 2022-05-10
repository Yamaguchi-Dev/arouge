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

        return $rule;
    }

    public function messages()
    {
        $messages = array();

        $messages['view_status.required'] = '公開・非公開を選択してください。';

        return $messages;
    }
}
