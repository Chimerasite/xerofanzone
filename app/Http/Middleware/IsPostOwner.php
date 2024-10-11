<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
use App\Models\FanCreations;

class IsPostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $post): Response
    {
        $slug = $request->route()->parameters()['post'];
        $user_id = FanCreations::where('slug', $slug)->first()->user_id;

        if(Auth::user()->id === $user_id || Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // Display a 403 Forbidden error
        abort(403);
    }
}
