<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Items;
use App\Models\Containers;

class ItemContainerStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'container_id',
        'item_id',
        'amount',
        'created_at',
        'updated_at',
    ];

    public function container(): BelongsTo
    {
        return $this->belongsTo(Containers::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Items::class);
    }
}
