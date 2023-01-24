<?php

namespace App\Data;

abstract class Data
{
    public function __toString(): string
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}
