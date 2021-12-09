<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyAdminRole
{

    const ADMIN_ROLE = 'Admin';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->checkOrFail();
            $isAdmin = false;
            $userInfo = $user->get('user');
            $userPermissions = $user->get('permissions');
            $userRoles = $user->get('roles');
            $userData = ['roles' => $userRoles, 'permissions' => $userPermissions, 'userInfo' => $userInfo];
            foreach ($userRoles as $role) {
                $isAdmin = $role->name == self::ADMIN_ROLE;
                if ($isAdmin)
                    break;
            }

            if ($isAdmin)
                $request->merge(['userData' => $userData]);
            else
                throw new \InvalidArgumentException('User does not have admin permission!');

        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return \response()->json(['status' => 'Token is Invalid'], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return \response()->json(['status' => 'Token is Expired'], 401);
            } else if ($e instanceof \Illuminate\Database\QueryException) {
                return $next($request);
            } else {
                return \response()->json(['status' => 'Authorization Token not found'], 403);
            }
        }
        return $next($request);
    }
}