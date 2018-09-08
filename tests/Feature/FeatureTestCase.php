<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use JsonSchema\Validator as JsonValidator;
use Tests\TestCase as BaseTestCase;
use App\Console\Commands\YamlToJson;

abstract class FeatureTestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    protected function prepareHeader(array $queryParams = [], array $bodyParams = [], $headers = [])
    {
        $this->withHeaders($headers);
    }

    protected function prepareUri($uri, array $queryParams)
    {
        $uri = '/api' .  $uri;
        $queryString = http_build_query($queryParams);
        $uri = $queryString ? $uri . '?' . $queryString : $uri;
        return $uri;
    }

    public function getJson($uri, array $queryParams = [], array $headers = [])
    {
        $uri = $this->prepareUri($uri, $queryParams);
        $this->prepareHeader($queryParams, []);
        return parent::getJson($uri, $headers);
    }

    public function postJson($uri, array $queryParams = [], array $bodyParams = [], array $headers = [])
    {
        $uri = $this->prepareUri($uri, $queryParams);
        $this->prepareHeader($queryParams, $bodyParams);
        return parent::postJson($uri, $bodyParams, $headers);
    }

    public function putJson($uri, array $queryParams = [], array $bodyParams = [], array $headers = [])
    {
        $uri = $this->prepareUri($uri, $queryParams);
        $this->prepareHeader($queryParams, $bodyParams);
        return parent::putJson($uri, $bodyParams, $headers);
    }

    public function deleteJson($uri, array $queryParams = [], array $bodyParams = [], array $headers = [])
    {
        $uri = $this->prepareUri($uri, $queryParams);
        $this->prepareHeader($queryParams, $bodyParams);
        return parent::deleteJson($uri, $bodyParams, $headers);
    }

    public function assertResponse(TestResponse $response, string $url, string $method, int $statusCode)
    {
        $response->assertStatus($statusCode);
        $json = json_decode(file_get_contents(base_path(YamlToJson::API_DOC_JSON)), true);
        $schema = $json['paths'][$url][$method]['responses'][$statusCode]['schema'];
        $schema['definitions'] = $json['definitions'];

        $object = json_decode($response->content());
        $jsonValidator = new JsonValidator();
        $jsonValidator->validate($object, $schema);
        $this->assertTrue($jsonValidator->isValid(), json_encode($jsonValidator->getErrors()));
    }
}
