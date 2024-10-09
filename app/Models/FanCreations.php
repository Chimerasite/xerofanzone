<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Users;

class FanCreations extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id',
            'name',
            'slug',
            'tags',
            'thumbnail',
            'description',
            'location',
            'art_permission',
            'writing_permission',
            'public',
            'contact',
            'external_link',
            'images',

    ];

    protected $casts = [
        'tags' => 'array',
        'images' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }
}


