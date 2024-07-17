<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ValidateSignature as BaseValidateSignature;
use Closure;

class ValidateSignature extends BaseValidateSignature
{
    public function handle($request, Closure $next, ...$args)
    {
        return parent::handle($request, $next, ...$args);
    }
}
