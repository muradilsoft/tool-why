<?php
/**
 * Created by borankux
 * User: mirzat
 * Date: 2018/9/8
 * Time: 3:30 PM
 * Github: https://github.com/borankux
 */

namespace App\Services;


use App\Entities\Question;

class QuestionService
{
    public function addQuestion(array $params)
    {
        $question = new Question();
        $question->title = $params['title'];
        $question->brief = isset($params['brief'])?$params['brief']:"";
        $question->save();
        return $question->toArray();
    }

    public function getAllQuestions(array $params)
    {
        $builder = Question::with([
            'author'
        ]);

        if(isset ($params['author_id'])) {
            $builder->where([
                'author_id' => $params['author_id']
            ]);
        }
        $questions = $builder->get();
        return $questions->toArray();
    }
}
