<?php
declare(strict_types=1);

namespace App\Services\Common;

use App\Exceptions\IncorrectStatusCodeException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
abstract class AbstractClient
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    /** @var Client|null */
    private ?Client $client = null;

    abstract protected function createDefaultClient(): Client;

    private function getDefaultClient(): Client
    {
        if ($this->client === null) {
            $this->client = $this->createDefaultClient();
        }
        return $this->client;
    }

    protected function prepareOptions(array &$options): void
    {

    }

    protected function prepareBody(array &$body): void
    {

    }

    /** @return mixed */
    final protected function sendRequest(
        string $method,
        string $uri,
        array $body = [],
        ?Client $customClient = null
    ) {
        return $this->sendRequestWithoutParams(
            $method,
            $uri,
            $body,
            $customClient
        );
    }

    /** @return mixed */
    final protected function sendRequestWithoutParams(
        string $method,
        string $uri,
        array $body = [],
        ?Client $customClient = null
    ) {
        $options = [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ];

        $this->prepareBody($body);
        switch ($method) {
            case self::METHOD_GET:
                $options[RequestOptions::QUERY] = $body;
                break;
            case self::METHOD_POST:
                $options[RequestOptions::JSON] = $body;
                break;
            default:
                throw new \LogicException('Undefined method ' . $method);
        }
        $this->prepareOptions($options);
        try {
            $client = $customClient ?? $this->getDefaultClient();
            $response = $client->request($method, $uri, $options);
        } catch (\Exception $exception) {
            Log::error('Exception: ' . $exception->getMessage());
            throw new IncorrectStatusCodeException($exception->getResponse());
        }

        if ($response->getStatusCode() !== 200) {
            // TODO: add ExceptionsLogger
            throw new IncorrectStatusCodeException($response);
        }

        $result = $response->getBody()->getContents();

        if (json_validate($result)) {
            return json_decode($result, true);
        }

        return $result;
    }
}
