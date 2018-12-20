<?php

namespace Union\Nucleus\Request;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

use Union\Nucleus\Exception\NucleusException;

/**
 * Class Request
 * @package Union\Nucleus
 * Provides the basic functionality for any request type.
 */
abstract class Request
{

    protected $uuid = null;

    public function __construct()
    {
        $this->verifyEnvironment();
    }

    /**
     * @return UuidInterface
     * @throws \Exception
     * Get or generate the Uuid for this request.
     */
    public function getUuid() : UuidInterface
    {

        $this->uuid = $this->uuid ?? Uuid::uuid4();

        return  $this->uuid;
    }

    /**
     * @throws NucleusException
     * Verifies that all required environment variables have been set.
     */
    private function verifyEnvironment() : void
    {

        if (!getenv('RAISERVICE_BASE_URL')) {
            throw new NucleusException('RAISERVICE_BASE_URL has not been set in the environment.');
        }

        if (!getenv('RAISERVICE_AUTH_USER')) {
            throw new NucleusException('RAISERVICE_AUTH_USER has not been set in the environment.');
        }

        if (!getenv('RAISERVICE_AUTH_PASSWORD')) {
            throw new NucleusException('RAISERVICE_AUTH_PASSWORD has not been set in the environment.');
        }
    }
}
