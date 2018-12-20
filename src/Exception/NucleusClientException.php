<?php

namespace Union\Nucleus\Exception;

use Throwable;

class NucleusClientException extends NucleusException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
