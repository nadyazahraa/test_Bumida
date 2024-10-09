<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class isAdmin
{
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check() && (Auth::user()->isAdmin || Auth::user()->isUser)) {
            $lastLogin = Auth::user()->last_login_at;

            if ($lastLogin != null) {
                $lastLoginTime = Carbon::parse($lastLogin)->format('Y-m-d H:i:s');
            } else if ($lastLogin == null) {
                $lastLoginTime = Carbon::now()->format('Y-m-d H:i:s');
            }

            $request->session()->put('lastLoginTime', $lastLoginTime);

            return $next($request);

        }

        return back()->with('error','Opps, You\'re not Admin');
    }

    public function terminate($request, $response)
    {
        //
    }
}
