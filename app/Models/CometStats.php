<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Items;

class CometStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'amount',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Items::class);
    }
}
