<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductionBasicAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! app()->environment('production')) {
            return $next($request);
        }

        $expectedUser = (string) config('security.admin_username');
        $expectedPassword = (string) config('security.admin_password');
        $providedUser = (string) $request->getUser();
        $providedPassword = (string) $request->getPassword();

        if ($expectedUser === '' || $expectedPassword === '') {
            abort(503, 'Production authentication is not configured.');
        }

        if (! hash_equals($expectedUser, $providedUser) || ! hash_equals($expectedPassword, $providedPassword)) {
            return response('Authentication required.', 401, [
                'WWW-Authenticate' => 'Basic realm="Student Management", charset="UTF-8"',
            ]);
        }

        return $next($request);
    }
}
