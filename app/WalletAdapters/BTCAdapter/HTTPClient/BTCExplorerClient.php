<?php
declare(strict_types = 1);

namespace App\WalletAdapters\BTCAdapter\HTTPClient;

use App\Services\Common\AbstractClient;
use GuzzleHttp\Client;

class BTCExplorerClient extends AbstractClient
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

    public function getBtcBalance(string $address)
    {
        return $this->sendRequest(
            'GET',
            '/q/addressbalance/' . $address);
    }
}
