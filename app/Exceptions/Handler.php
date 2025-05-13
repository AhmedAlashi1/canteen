<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            // Code for API specific error handling

            // Return an API response with the error message
            return  sendError( $exception->getMessage());

        }elseif ($exception instanceof MethodNotAllowedHttpException) {
            return response()->view('errors.405', [], 405);
        }elseif ($exception instanceof NotFoundHttpException) {

                if (
                    !($request->is('ar/admin*') || $request->is('en/admin*')) &&
                    !$request->is('telescope*')

                ) {
                    return response()->view('errors.404', [], 404);
                }
            }

        return parent::render($request, $exception);
    }
}
