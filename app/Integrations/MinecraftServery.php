<?php

namespace App\Integrations;

use App\Data\PlayerInfo;
use App\Data\ServerInfo;

class MinecraftServery extends Integration
{
    protected string $base_uri = 'https://api.minecraftservery.eu/';
    protected string $identifier_env_path = 'MINECRAFTSERVERY_ID';

    public function getServerInfo(): ?ServerInfo {
        $data = $this->request(
            'info?id=' . $this->identifier
        );

        if (!$data)
            return null;

        return new ServerInfo(
            null,
            $data->votes,
            'https://minecraftservery.eu/server/' . env('MINECRAFTSERVERY_SLUG'),
        );
    }

    public function getPlayerInfo(string $nick): ?PlayerInfo {
        $data = $this->request(
            'player?id=' . $this->identifier . '&nickname=' . $nick
        );

        if (!$data)
            return null;

        if (isset($data->error) && $data->error == 'Přezdívka nenalezena.') {
            return new PlayerInfo(
                $nick,
                0,
                time(),
                'https://minecraftservery.eu/server/' . env('MINECRAFTSERVERY_SLUG') .
                '/vote/' . $nick,
            );
        }

        return new PlayerInfo(
            $nick,
            $data->vote_count,
            $data->next_vote_timestamp,
            'https://minecraftservery.eu/server/' . env('MINECRAFTSERVERY_SLUG') .
            '/vote/' . $nick,
        );
    }
}
