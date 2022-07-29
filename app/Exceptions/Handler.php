<?php

namespace App\Exceptions;

use stdClass;
use Exception;
use App\Traits\GlobalWarn as Warn;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        // $res = new stdClass;
        // $res->status = 'error';
        // $res->title = 'Gagal';
        // if ($exception instanceof ModelNotFoundException) {
        //     $res->message = $exception->getMessage();
        //     return redirect()->back()->with(json_encode($res));
        // }
        // if ($exception instanceof \Illuminate\Database\QueryException) {
        //     $res->message = $exception->getMessage();
        //     return redirect()->back()->with(json_encode($res));
        // } elseif ($exception instanceof \PDOException) {
        //     $res->message = $exception->getMessage();
        //     return redirect()->back()->with(json_encode($res));
        // }
        
        return parent::render($request, $exception);
    }
}
