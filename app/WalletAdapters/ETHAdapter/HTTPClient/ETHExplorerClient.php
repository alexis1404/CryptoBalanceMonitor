<?php
declare(strict_types = 1);

namespace App\WalletAdapters\ETHAdapter\HTTPClient;

use App\Services\Common\AbstractClient;
use GuzzleHttp\Client;

class ETHExplorerClient extends AbstractClient
{
    /** @var string */
    protected string $explorerHost;
    /** @var string */
    protected string $apiKey;

    public function __construct(string $explorerHost, string $apiKey)
    {
        $this->explorerHost = $explorerHost;
        $this->apiKey = $apiKey;
    }

    protected function createDefaultClient(): Client
    {
        return new Client(['base_uri' => $this->explorerHost, 'verify' => false]);
    }

    public function getEthereumBalance(string $address): array
    {
        return $this->sendRequest(
            'GET',
            '/api',
            [
                'module' => 'account',
                'action' => 'balance',
                'address' => $address,
                'tag' => 'latest',
                'apikey' => $this->apiKey,
            ],
            null
        );
    }
}
