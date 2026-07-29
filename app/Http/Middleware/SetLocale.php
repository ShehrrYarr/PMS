<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\ThemeSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    private const SUPPORTED_LOCALES = ['en', 'ur'];

    /**
     * Resolve the active locale for this request: session choice first,
     * falling back to the shop's configured default_locale (theme_settings),
     * falling back to the app config default.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale');

        if (! in_array($locale, self::SUPPORTED_LOCALES, true)) {
            $locale = ThemeSetting::query()->value('default_locale') ?? config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
