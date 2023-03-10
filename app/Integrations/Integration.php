<?php

namespace App\Integrations;

use App\Data\PlayerInfo;
use App\Data\ServerInfo;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

abstract class Integration
{
    protected string $base_uri;
    protected string $identifier_env_path;

    protected Client $client;
    protected string $identifier;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->base_uri,
            'timeout' => 5,
        ]);

        $this->identifier = env($this->identifier_env_path);
    }

    abstract public function getServerInfo(): ?ServerInfo;
    abstract public function getPlayerInfo(string $nick): ?PlayerInfo;

    protected function request(string $uri): object|array|null {
        try {
            $response = $this
                ->client
                ->get($uri);
        } catch (ClientException $e) {
            return null;
        }

        return json_decode($response->getBody());
    }
}
