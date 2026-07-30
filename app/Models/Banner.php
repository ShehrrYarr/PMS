<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\BelongsToShop;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use BelongsToShop;

    protected $fillable = [
        'shop_id',
        'image_path',
    ];
}
