<?php

namespace App\Exceptions;

use App\Exceptions\InvalidOrderException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        $this->renderable(function ($request, Exception $ex) {
            if ($this->isHttpException($ex)) {
                if ($ex->getStatusCode() == 500) {
                    return response()->view('errors.' . '500', ['exception' => $ex], 500);
                }
                if ($ex->getStatusCode() == 404) {
                    return response()->view('errors.' . '404', ['exception' => $ex], 404);
                }
                if ($ex->getStatusCode() == 403) {
                    return response()->view('errors.' . '403', ['exception' => $ex], 403);
                }
            }
            return parent::render($request, $ex);
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return redirect()->back()->with('error', 'Requested record not found or deleted!');
        }
        return parent::render($request, $e);
    }
}
