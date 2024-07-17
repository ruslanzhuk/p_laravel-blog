<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Post;

class CheckCommentsType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::find($request->id);

        if ($post && $post->comments_type == 'everyone') {
            return $next($request);
        }

        if (auth()->check()) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
