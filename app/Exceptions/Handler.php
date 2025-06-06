<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
    }

    public function render($request, Throwable $exception)
{
    if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface) {
        if ($exception->getStatusCode() == 403) {
            $user = auth()->user();
            $defaultRoute = 'dashboard';
            
            if ($user) {
                $roleRedirect = [
                    4 => 'stock',
                    7 => 'trabajadores.index'
                ];
                $defaultRoute = $roleRedirect[$user->id_rol] ?? 'dashboard';
            }
            
            return response()->view('errors.403', ['defaultRoute' => $defaultRoute], 403);
        }
    }

    return parent::render($request, $exception);
}
}
