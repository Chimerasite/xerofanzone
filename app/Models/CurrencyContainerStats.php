<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Containers;

class CurrencyContainerStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'container_id',
        'amount',
        'created_at',
        'updated_at',
    ];

    public function container(): BelongsTo
    {
        return $this->belongsTo(Containers::class);
    }

}
