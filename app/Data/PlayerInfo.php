<?php

namespace App\Data;

class PlayerInfo extends Data
{
    public function __construct(
        public string $nick,
        public int $votes_count,
        public int $next_vote,
        public string $vote_url,
    ) {}
}
