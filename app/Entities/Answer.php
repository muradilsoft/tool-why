<?php

namespace App\Entities;

use Author;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class, 'id', 'question_id');
    }

    public function author()
    {
        return $this->hasOne(Author::class, 'id', 'author_id');
    }
}
