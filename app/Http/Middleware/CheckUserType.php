<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user_id = Auth::id();
        $userType = User::validateAccountNavigations($user_id);
        foreach ($roles as $role) {
            if ($userType == $role) {
                return $next($request);
            }
        }
        return redirect('/home');
    }
}
