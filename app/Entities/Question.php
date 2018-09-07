<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
