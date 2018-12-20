<?php

namespace Union\Nucleus\Request;

interface RequestInterface
{
    public function getAuth()          : array;
    public function getBody();
    public function getRequestMethod() : string;
    public function getContentType()   : string;
    public function getUrl()           : string;
    public function getUuid();
}
