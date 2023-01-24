<?php

namespace App\Http\Middlewares;

use Lemon\Http\Request;

class TokenAuth
{
    public function handle(Request $request)
    {
        if (!env('TOKEN'))
            return response('Token is not set in .env file.')
                ->code(500);

        if ($request->query('token') != env('TOKEN'))
            return response('Unauthorized.')
                ->code(401);
    }
}
