<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Exceptions\InvalidSignatureException;

class signedAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dd('signed Admin');
        // if ($request->hasValidSignature()) {
        //     return $next($request);
        // }

        // throw new InvalidSignatureException;

    }
}
