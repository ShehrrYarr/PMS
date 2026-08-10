<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\PosDevice;
use App\Services\OfflineDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Serves the snapshot a till caches when it goes offline, registering the
 * device on first use.
 *
 * Also called on a timer while online, to keep an already-prepared till's
 * copy of stock and balances from drifting too far.
 */
class OfflineDataController extends Controller
{
    public function __invoke(Request $request, OfflineDataService $offlineDataService): JsonResponse
    {
        $validated = $request->validate([
            'device_id' => ['nullable', 'integer'],
            'label' => ['nullable', 'string', 'max:255'],
        ]);

        $user = $request->user();
        $device = $this->resolveDevice($validated, $user->id, $user->shop_id);

        return response()->json($offlineDataService->snapshotFor($user, $device));
    }

    /**
     * A device id is only honoured if it really belongs to this shop —
     * otherwise a till would be handed another tenant's invoice sequence.
     * Anything unrecognised simply registers as a new device.
     *
     * @param  array<string, mixed>  $validated
     */
    private function resolveDevice(array $validated, int $userId, int $shopId): PosDevice
    {
        $deviceId = $validated['device_id'] ?? null;

        if ($deviceId !== null) {
            $existing = PosDevice::query()
                ->where('id', (int) $deviceId)
                ->where('shop_id', $shopId)
                ->first();

            if ($existing !== null) {
                return $existing;
            }
        }

        return PosDevice::query()->create([
            'shop_id' => $shopId,
            'user_id' => $userId,
            'label' => $validated['label'] ?? null,
        ]);
    }
}
