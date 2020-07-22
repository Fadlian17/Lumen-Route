<?php

namespace App\Http\Middleware;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Log;
use Closure;

class AuthJwtTokenMiddleware
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
        $token = $request->bearerToken();
        $key_token = "kode_token";

        if (!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, $key_token, ['HS256']);
            if (!$credentials) {
                Log::error('An error while decoding token.');

                return response()->json([
                    'error' => 'An error while decoding token.'
                ], 400);
            } else {
                Log::info('Token has been provided');

                return $next($request);
            }
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token.'
            ], 400);
        }
        // $user = User::find($credentials->sub);
        // // Now let's put the user in the request class so that you can grab it from there
        // $request->auth = $user;
        return $next($request);
    }
}
