<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
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

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('電話番号を正しく入力してください');
    }
}
