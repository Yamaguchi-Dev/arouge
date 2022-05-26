<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswersChoice extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo('App\Models\Question','questions_id', 'id');
    }

    public function choice()
    {
        return $this->belongsTo('App\Models\Choice','choices_id', 'id');
    }
}
