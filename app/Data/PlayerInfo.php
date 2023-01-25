<?php

namespace App\Data;

class PlayerInfo
{
    public function __construct(
        public readonly string $nick,
        public readonly int $votes_count,
        public readonly int $next_vote,
        public readonly string $vote_url,
    ) {}
}
