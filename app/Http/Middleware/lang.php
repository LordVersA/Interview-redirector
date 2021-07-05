<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class lang
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (request("lang")) {
            session()->put('lang', request('lang'));
            $lang = request('lang');
        } elseif (session('lang')) {
            $lang = session('lang');
        } elseif (config("app.locale")) {
            $lang = config("app.locale");
        }

        if (isset($lang)) {
            app()->setLocale($lang);

        }
        return $next($request);
    }
}
