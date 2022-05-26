<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function choice()
    {
        return $this->hasMany('App\Models\Choice','questions_id', 'id');
    }
}
