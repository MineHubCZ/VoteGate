<?php

namespace App\Integrations;

use App\Data\PlayerInfo;
use App\Data\ServerInfo;

class CzechCraft extends Integration
{
    protected string $base_uri = 'https://czech-craft.eu/api/';
    protected string $identifier_env_path = 'CZECH_CRAFT_SLUG';

    public function fetchServerInfo(): ?ServerInfo {
        $data = $this->request(
            'server/' . $this->identifier
        );

        if (!$data)
            return null;

        return new ServerInfo(
            $data->position,
            $data->votes,
            'https://czech-craft.eu/server/' . $this->identifier,
        );
    }

    public function fetchPlayerInfo(string $nick): ?PlayerInfo {
        $data = $this->request(
            'server/' . $this->identifier . '/player/' . $nick
        );

        if (!$data)
            return null;

        return new PlayerInfo(
            $nick,
            $data->vote_count,
            strtotime($data->next_vote),
            'https://czech-craft.eu/server/' . $this->identifier . '/vote?user=' . $nick,
        );
    }
}
