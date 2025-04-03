<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Items;

class Containers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'item_id',
        'type',
        'splits',
        'active',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'splits' => 'array',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Items::class);
    }
}
