<?php

namespace App\Exceptions;

use Exception;

class DomainException extends Exception
{

    public $code;
    public $message;
    public $trace;

    public function __construct( $message, $code, Exception $exception=NULL, $customMessage="#")

    {
        parent::__construct($message, $code, $exception);
        $this->code = $code;
        $this->message=$message;
        if(!empty($customMessage)){
            $this->trace= $customMessage;
        }else{
            $this->trace= $exception->getMessage();
        }

    }

    public function render($request)
    {
        if($this->trace == "#"){
            return response()->json(["error" => true, "message" => $this->message], 400);
        }
        return response()->json(["error" => true, "message" => $this->message, "trace" => $this->trace], 400);
    }
}
