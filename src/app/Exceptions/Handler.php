<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

         $this->renderable(function (\Exception $e, $request) {
            // 419エラー: CSRFトークンミスマッチエラーの場合の処理
            if ($e->getPrevious() instanceof TokenMismatchException) {
                return redirect()->route('auth.login')->withErrors([
                    'errors' => trans('auth.csrf_token_mismatched')
                ]);
            };
        });
    }
}
