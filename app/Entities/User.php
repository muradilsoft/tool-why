<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class, 'author_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'author_id', 'id');
    }
}
