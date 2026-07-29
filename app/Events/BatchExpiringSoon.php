<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Batch;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BatchExpiringSoon
{
    use Dispatchable, SerializesModels;

    public function __construct(public readonly Batch $batch) {}
}
