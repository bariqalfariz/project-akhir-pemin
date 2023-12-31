<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\Mahasiswa;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

// Bagas Mahda Dhani - 215150700111038
class JwtMiddleware
{
    function handle($request, Closure $next, $guard = null)
    {
    $token = $request->header('token') ?? $request->query('token');
    // $token = $request->get('token');
    
    if (!$token) {
        //Unauthorized response if token not there
        return response()->json([
            'error' => 'Token not provided.'
        ], 401);
    }

    try {
        $credentials =
            JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
    } catch (ExpiredException $e) {
        return response()->json([
            'error' => 'Provided token is expired.'
        ], 400);
    } catch (Exception $e) {
        return response()->json([
            'error' => 'An error while decoding token.'
        ], 400);
    }

    $user = Mahasiswa::find($credentials->sub);
    
    $request->user = $user;
    return $next($request);
    }
}
