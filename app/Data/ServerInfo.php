<?php

namespace App\Data;

class ServerInfo
{
    public function __construct(
        public readonly ?int $position,
        public readonly int $votes_count,
        public readonly string $url,
    ) {}
}
