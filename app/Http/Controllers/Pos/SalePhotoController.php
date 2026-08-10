<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Attaches a customer photo captured during an offline credit sale.
 *
 * Deliberately a separate request per sale, made only after the sale row
 * exists: cPanel's stock PHP limits (upload_max_filesize 2M, post_max_size 8M,
 * max_file_uploads 20) would quietly truncate a multi-day batch of photos sent
 * alongside the sales themselves. Keeping it separate also means a failed
 * photo upload can never cost us the sale.
 */
class SalePhotoController extends Controller
{
    public function __invoke(Request $request, string $shop, Sale $sale): JsonResponse
    {
        $this->authorize('create', Sale::class);

        $request->validate([
            'photo' => ['required', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        // Only ever fills a gap — a photo already on the record is never
        // replaced, since sales are otherwise immutable once posted.
        if ($sale->photo_path !== null) {
            return response()->json(['ok' => true, 'photo_path' => $sale->photo_path]);
        }

        // Extension follows the validated MIME type rather than being forced
        // to .jpg — a PNG stored as .jpg confuses anything that trusts the
        // suffix.
        $extension = match ($request->file('photo')->getMimeType()) {
            'image/png' => 'png',
            'image/webp' => 'webp',
            default => 'jpg',
        };

        $path = $request->file('photo')->storeAs('sale-photos', "{$sale->id}.{$extension}", 'public');

        $sale->forceFill(['photo_path' => $path])->save();

        return response()->json(['ok' => true, 'photo_path' => $path]);
    }
}
