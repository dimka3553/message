<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user= auth()->user();
        if(!$user->is_admin??false){
            abort(403);
        }
        return $next($request);
    }
}
