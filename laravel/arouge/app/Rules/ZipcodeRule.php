<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ZipcodeRule implements Rule
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
        if (empty(str_replace("-", "", $value))) return true;
        $zip = explode("-", $value);
        if (count($zip) != 2) return false;
        $len1 = strlen($zip[0]);
        $len2 = strlen($zip[1]);
        if($len1 != 3 || $len2 != 4) return false;
        if(!preg_match('/^[0-9]{7}$/', $zip[0].$zip[1])) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('郵便番号を正しく入力してください');
    }
}
