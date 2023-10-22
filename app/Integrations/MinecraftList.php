<?php

namespace App\Integrations;

use App\Data\PlayerInfo;
use App\Data\ServerInfo;

class MinecraftList extends Integration
{
    protected string $base_uri = 'https://www.minecraft-list.cz/api/';
    protected string $identifier_env_path = 'MINECRAFT_LIST_SLUG';

    public function fetchServerInfo(): ?ServerInfo {
        $data = $this->request(
            'server/' . $this->identifier
        );

        if (!$data)
            return null;

        return new ServerInfo(
            $data->rank,
            $data->votes,
            'https://www.minecraft-list.cz/server/' . $this->identifier,
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
            $data->votes_count,
            strtotime($data->next_vote_at),
            'https://www.minecraft-list.cz/server/' . $this->identifier . '/vote?name=' . $nick,
        );
    }
}
