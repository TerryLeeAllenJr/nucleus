<?php

namespace Union\Nucleus\Response;

interface ResponseInterface
{
    public function getBody();

    public function getStatusCode() : int;

    public function normalize();

    public function validate(string $body) : bool;

    public function setBody(string $body) : void;

    public function setStatusCode($statusCode) : void;
}
