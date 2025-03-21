<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Session::get('locale'));
        $locale = Session::get('locale', 'ar');
        Session::put('locale', $locale);
        App::setLocale($locale);

        // dd(Session::get('locale'), app()->getLocale());

        return $next($request);
    }
}
