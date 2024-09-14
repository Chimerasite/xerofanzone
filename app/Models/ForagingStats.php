<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Items;
use App\Models\ForagingLocations;

class ForagingStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'foraging_location_id',
        'item_id',
        'amount',
    ];

    protected $rules = [
        'name' => [
            'required',
            'unique:XeroForagingStats,name',
        ],
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(ForagingLocations::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Items::class);
    }
}
