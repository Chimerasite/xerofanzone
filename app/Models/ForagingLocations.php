<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ForagingStats;

class ForagingLocations extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'type',
        'start_date',
        'end_date',
    ];

    public function stat(): HasMany
    {
        return $this->hasMany(ForagingStats::class);
    }
}
