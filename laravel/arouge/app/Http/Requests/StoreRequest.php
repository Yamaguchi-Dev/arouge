<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\ZipcodeRule;
use App\Rules\PhoneRule;

class StoreRequest extends FormRequest
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
        $rule['name'] = ['required', 'max:100'];
        $rule['zipcode'] = ['required', new ZipcodeRule()];
        $rule['pref_id'] = ['required'];
        $rule['address'] = ['required', 'max:100'];
        $rule['tel'] = ['required', new PhoneRule()];
        $rule['bland'] = ['required'];

        return $rule;
    }

    public function messages()
    {
        $messages = array();

        $messages['name.required'] = '店名を入力してください。';
        $messages['name.max'] = '店名は100文字以内で入力してください。';

        $messages['zipcode.required'] = '郵便番号を入力してください。';

        $messages['pref_id.required'] = '都道府県を選択してください。';

        $messages['address.required'] = '住所を入力してください。';
        $messages['address.max'] = '住所は100文字以内で入力してください。';

        $messages['tel.required'] = '電話番号を入力してください。';

        $messages['bland.required'] = 'お取り扱い状況を選択してください。';


        return $messages;
    }

    public function validationData()
    {
        $data = $this->all();
        return $data;
    }

}

