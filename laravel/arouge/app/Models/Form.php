<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;


    public function question()
    {
        return $this->hasMany('App\Models\Question','forms_id', 'id');
    }

    public function answer_user()
    {
        return $this->hasMany('App\Models\AnswerUser','forms_id', 'id');
    }
}
