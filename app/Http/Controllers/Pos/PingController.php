<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * The till's "are we really online?" probe.
 *
 * navigator.onLine only reports whether a network interface is up — it says
 * true on a router with no working internet — so the offline POS confirms
 * reachability by actually hitting this.
 *
 * It also hands back a fresh CSRF token. The till must never store one: a
 * token is tied to the session and rotates on login, so a token cached with
 * the offline page would be stale by the time a queue is finally synced.
 */
class PingController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'ok' => true,
            'authenticated' => true,
            'csrf' => $request->session()->token(),
            'server_time' => now()->toIso8601String(),
            'user_id' => $request->user()->id,
        ]);
    }
}
