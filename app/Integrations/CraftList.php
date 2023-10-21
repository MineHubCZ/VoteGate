<?php

namespace App\Integrations;

use App\Data\PlayerInfo;
use App\Data\ServerInfo;
use Exception;

class CraftList extends Integration
{
    protected string $base_uri = 'https://api.craftlist.org/v1/';
    protected string $identifier_env_path = 'CRAFTLIST_API_TOKEN';

    public function getServerInfo(): ?ServerInfo {
        $data = $this->request(
            $this->identifier . '/info'
        );

        if (!$data)
            return null;

        return new ServerInfo(
            $data->rank,
            $data->votes,
            'https://craftlist.org/' . env('CRAFTLIST_SLUG'),
        );
    }

    public function getPlayerInfo(string $nick): ?PlayerInfo {
        $data = $this->request(
            $this->identifier . '/votes/' . date('Y') . '/'.
            date('m') . '?merge=1&nickname=' . $nick
        );

        if (!$data)
            return null;

        return new PlayerInfo(
            $nick,
            $data[0]->votes,
            $data[0]->nextPossibleVote,
            'https://craftlist.org/' . env('CRAFTLIST_SLUG') . '?nickname=' . $nick,
        );
    }
}
