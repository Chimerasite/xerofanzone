<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ForagingStats;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'forageable',
    ];

    protected $rules = [
        'name' => [
            'required',
            'unique:XeroForagingStats,name',
        ],
    ];

    public function stat(): HasMany
    {
        return $this->hasMany(ForagingStats::class);
    }

    public function cometstat(): HasMany
    {
        return $this->hasMany(CometStats::class);
    }
}
