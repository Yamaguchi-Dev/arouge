<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerUser extends Model
{
    use HasFactory;

    public function answer_choice()
    {
        return $this->hasMany('App\Models\AnswersChoice','answer_users_id', 'id');
    }
}
