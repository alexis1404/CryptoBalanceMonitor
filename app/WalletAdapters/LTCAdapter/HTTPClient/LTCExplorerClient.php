<?php
declare(strict_types = 1);

namespace App\WalletAdapters\LTCAdapter\HTTPClient;

use App\Services\Common\AbstractClient;
use GuzzleHttp\Client;

class LTCExplorerClient extends AbstractClient
{
    /** @var string */
    protected string $explorerHost;

    public function __construct(string $explorerHost)
    {
        $this->explorerHost = $explorerHost;
    }

    protected function createDefaultClient(): Client
    {
        return new Client(['base_uri' => $this->explorerHost, 'verify' => false]);
    }

    public function getLTCBalance(string $address): array
    {
        return $this->sendRequest(
            'GET',
            '/v1/ltc/main/addrs/' . $address . '/balance'
        );
    }
}
