<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Every layout in this app reads theme_settings/receipt_settings (see
     * ThemeSetting::current()), which throws ModelNotFoundException — and
     * therefore renders as a 404 — if the row doesn't exist. Auto-seed so
     * RefreshDatabase tests get a working app, not just an empty schema.
     */
    protected $seed = true;
}
