<?php

namespace Union\Nucleus\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Union\Nucleus\Request\RequestInterface;
use Union\Nucleus\Response\ResponseInterface;
use Union\Nucleus\Exception\NucleusClientException;

/**
 * Class GuzzleClient
 * @package Union\Nucleus\Client
 * @author Lee Allen
 * Guzzle wrapper for making HTTP requests to RAI.
 */
class GuzzleClient implements ClientInterface
{
    private $request;
    private $response;

    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        // Give the rest of the Client access to the request and response instances.
        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * @return ResponseInterface
     * @throws NucleusClientException
     * Executes the request and returns an instance of ResponseInterface.
     */
    public function send() : ResponseInterface
    {
        // Get the Guzzle request and response objects.
        $client = $this->getClient();
        $request = $this->getRequest();

        // Ready, aim, fire that bad boy.
        $response = $client->send($request);

        // Let's check on some things.
        $statusCode = $response->getStatusCode();

        // Better make sure it came back correctly.
        if ($statusCode !== 200) {
            throw new NucleusClientException("$statusCode response received.");
        }

        // Let's setup the response.
        $this->response->setStatusCode($statusCode);

        // Note: The Response object should validate and format the response when building the body.
        $this->response->setBody((string)$response->getBody());

        // Returning the response so that consumers can further manipulate if needed.
        return $this->response;
    }

    /**
     * @return Client
     * Gets an instance of GuzzleHttp\Client.
     */
    private function getClient() : Client
    {
        return new Client([
            'base_uri' => $this->request->getUrl(),
            'headers' => [
                'Content-Type' => $this->request->getContentType(),
            ],
            'auth' => $this->request->getAuth(),
            'debug' => false,
            'defaults' =>  [
                'verify' => false,
            ],
        ]);
    }

    /**
     * @return Request
     * Gets a new instance of GuzzleHttp\Request
     */
    private function getRequest() : Request
    {
        return new Request(
            $this->request->getRequestMethod(),
            $this->request->getContentType(),
            $this->request->getBody()
        );
    }
}
