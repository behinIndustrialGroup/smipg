<?php

namespace Mkhodroo\UserRoles\Middlewares;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mkhodroo\UserRoles\Controllers\AccessController;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $method = null)
    {
        if(!Auth::id()){
            return abort(403, 'ابتدا وارد شوید');
        }
        $user = Auth::user();
        if($user->login_with_ip){
            if($user->valid_ip != $request->ip()){
                return abort(403, "آیپی شما معتبر نیست");
            }
        }
        $target = $method ?? $request->route()->uri();
        $a = new AccessController($target);
        if(!$a->check()){
            return abort(403, "Forbidden For Route: " . $target);
        }

        return $next($request);
    }
}
