<?php

namespace App\Exceptions;


use App\Http\Controllers\Responses\ResponseCodes;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\Responses\RespondsJson;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

class Handler extends ExceptionHandler
{
    use RespondsJson;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof HttpException) {
            if (! $exception instanceof ApiException) {
                $exception = $this->prepareApiException($exception);
            }
            return $this->failed($exception->getStatusCode(), $exception->getCode(), $exception->getMessage());
        }

        if (config('app.debug', false)) {
            return $this->prepareResponse($request, $exception);
        }

        return $this->failed(
            FoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
            ResponseCodes::CODE_INTERNAL_SERVER_ERROR,
            ResponseCodes::getMessage(ResponseCodes::CODE_INTERNAL_SERVER_ERROR)
        );
    }

    public function prepareApiException(HttpException $exception)
    {
        $errorCode = ResponseCodes::getErrorCode($exception->getStatusCode());
        return new ApiException($errorCode, $exception->getMessage(), $exception);
    }
}
