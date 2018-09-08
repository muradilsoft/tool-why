<?php
/**
 * Created by borankux
 * User: mirzat
 * Date: 2018/9/8
 * Time: 2:51 PM
 * Github: https://github.com/borankux
 */

namespace Tests\Feature\Controllers;


use Tests\Feature\FeatureTestCase;

class QuestionControllerTest extends FeatureTestCase
{
    public function testAdd_success()
    {
        $response = $this->postJson('/questions',[], [
            'title' => 'this is the title of the question'
        ]);

        $this->assertResponse($response, '/questions', 'post', 201);
        $this->assertTrue(true);
    }

    public function testGetAll()
    {
        $response = $this->getJson('/questions');
    }
}
