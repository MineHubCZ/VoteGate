<?php

namespace App\Data;

class ServerInfo extends Data
{
    public function __construct(
        public ?int $position,
        public int $votes_count,
        public string $url,
    ) {}
}
