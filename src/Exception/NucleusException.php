<?php

namespace Union\Nucleus\Exception;

use Throwable;
use \Exception;

class NucleusException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
