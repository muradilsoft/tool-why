<?php
/**
 * Created by borankux
 * User: mirzat
 * Date: 2018/9/8
 * Time: 12:48 AM
 * Github: https://github.com/borankux
 */

namespace App\Http\Controllers;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $questionService;
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function add(Request $request)
    {
        $params = $this->parseRequest($request, [
            'body_name' => 'body_question'
        ]);
        $question = $this->questionService->addQuestion($params);
        return $this->created($question);
    }

    public function getAll(Request $request){
        $params = $this->parseRequest($request, [
            'query_name' => [
                'query_authorId'
            ]
        ]);
        $questions = $this->questionService->getAllQuestions($params);
        return $this->ok($questions);
    }
}


