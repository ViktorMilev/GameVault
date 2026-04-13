<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;


class LoadTranslations
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = app()->getLocale();
        
        // add 3600 seconds (1 hour) cache back in after all translations are added
        $translations = Cache::remember("translations_all_{$locale}", 0, function() use ($locale) {
            $path = resource_path("lang/{$locale}");
            $files = array_map(fn($file) => pathinfo($file, PATHINFO_FILENAME), glob($path . '/*.php'));

            $data = [];

            foreach ($files as $file) {
                $data[$file] = trans($file, [], $locale);
            }

            return $data;
        });

        View::share('t', $translations);
        app()->singleton('t', fn() => $translations);

        return $next($request);
    }
}
