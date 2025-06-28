<?php

namespace App\Http\Middleware;

use Closure;
use Domain\User\Enum\RoleEnum;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->role === RoleEnum::ADMIN->value) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Доступ запрещён',
            'errors' => ['У вас недостаточно прав'],
        ], 403);
    }
}
