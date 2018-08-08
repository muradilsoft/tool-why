<?php
/**
 * Created by borankux.
 * User: frank
 * Date: 2018/8/9
 * Time: 3:46 AM
 */

namespace App\Http\Responses;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

trait RespondsJson
{

    private function respond($statusCode, $body, $header = [])
    {
        $response = response()->json($body, $statusCode, $header);
        Log::debug($response);
        return $response;
    }

    private function format(int $code, string $message, array $data = [], array $paginate = [])
    {
        $meta = array();
        $meta['code'] = $code;
        $meta['message'] = $message;

        $body = array();
        $body['meta'] = $meta;
        if (! empty($data)) {
            $body['data'] = $data;
        }

        if (! empty($paginate)) {
            $body['paginate'] = $paginate;
        }

        return $body;
    }

    public function failed(int $statusCode, int $code, string $message, $header = [])
    {
        $body = $this->format($code, $message);
        return $this->respond($statusCode, $body, $header);
    }


    public function ok(array $data = [], $paginate = [], $header = [])
    {
        $body = $this->format(ResponseCodes::CODE_OK, 'Success', $data, $paginate);
        return $this->respond(FoundationResponse::HTTP_OK, $body, $header);
    }

    public function accept(array $data = [], $header = [])
    {
        $body = $this->format(ResponseCodes::CODE_ACCEPTED, 'Success', $data);
        return $this->respond(FoundationResponse::HTTP_ACCEPTED, $body, $header);
    }

    public function created(array $data = [], $header = [])
    {
        $body = $this->format(ResponseCodes::CODE_CREATED, 'Success', $data);
        return $this->respond(FoundationResponse::HTTP_CREATED, $body, $header);
    }

    public function noContent(array $data = [], $header = [])
    {
        $body = $this->format(ResponseCodes::CODE_NO_CONTENT, 'Success', $data);
        return $this->respond(FoundationResponse::HTTP_OK, $body, $header);
    }
}
