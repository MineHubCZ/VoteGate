<?php

namespace App;

use App\Integrations\CzechCraft;
use App\Integrations\CraftList;
use App\Integrations\MinecraftList;
use App\Integrations\MinecraftServery;

class Services
{
    public readonly array $services;

    public function __construct() 
    {
        $this->services = [
            'CZECH_CRAFT' => new CzechCraft(),
            'CRAFTLIST' => new CraftList(),
            'MINECRAFT_LIST' => new MinecraftList(),
            'MINECRAFTSERVERY' => new MinecraftServery(),
        ];
    }

    public function getServerInfo(): array
    {
        $output = [];

        foreach ($this->services as $name => $service) {
            $output[$name] = $service->getServerInfo();
        }

        return $output;
    }

    public function getPlayerInfo(string $nick): array
    {
        $output = [];

        foreach ($this->services as $name => $service) {
            $output[$name] = $service->getPlayerInfo($nick);
        }

        return $output;
    }
   
}
