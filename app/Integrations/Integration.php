<?php

namespace App\Integrations;

use App\Data\PlayerInfo;
use App\Data\ServerInfo;
use Exception;
use GuzzleHttp\Client;
use Lemon\Cache;

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
            'headers' => [
                'User-Agent' => 'GuzzleHttp/'.Client::MAJOR_VERSION.' MineHubCZ/VoteGate running at '.env('BASE_URL'),
            ],
        ]);

        $this->identifier = env($this->identifier_env_path);
    }

    abstract public function fetchServerInfo(): ?ServerInfo;
    abstract protected function fetchPlayerInfo(string $nick): ?PlayerInfo;

    public function getServerInfo(): ?ServerInfo {
        return $this->fetchServerInfo();
    }

    public function getPlayerInfo(string $nick, bool $cached = true): ?PlayerInfo {
        $cache_key = get_class($this).'#'.$nick;

        if ($cached && Cache::has($cache_key)) {
            $data = Cache::get($cache_key);
            return $data ? PlayerInfo::fromArray($data) : null;
        }

        $data = $this->fetchPlayerInfo($nick);

        // If player can vote now or data are null, cache for 30 seconds. Otherwise cache until next_vote.
        $ttl = $data ? (time() - $data->next_vote) : 0;
        $ttl = $ttl <= 0 ? 30 : $ttl;

        Cache::set($cache_key, $data, $ttl);

        return $data;
    }

    protected function request(string $uri): object|array|null {
        try {
            $response = $this
                ->client
                ->get($uri);
        } catch (Exception $e) {
            return null;
        }

        return json_decode($response->getBody());
    }
}
