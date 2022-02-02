<?php

namespace App\Exceptions;

use Exception;

class DomainException extends Exception
{

    public $code;
    public $message;
    public $trace;

    public function __construct( $message, $code, Exception $exception=NULL)

    {
        parent::__construct($message, $code, $exception);
        $this->code = $code;
        $this->message=$message;
        $this->trace= $exception->getMessage();
    }

    public function render($request)
    {
        return response()->json(["error" => true, "message" => $this->message, "trace" => $this->trace], 400);
    }
}
