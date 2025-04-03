<?php

namespace App\Exceptions;

use Psr\Http\Message\ResponseInterface;
class IncorrectStatusCodeException extends \Exception
{
    /** @var string */
    protected $body;
    public function __construct(ResponseInterface $response)
    {
        $this->body = $response->getBody()->getContents();
        $message = 'Response Code: ' . $response->getStatusCode() . '\n'
            . $this->body;
        parent::__construct($message, $response->getStatusCode());
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
