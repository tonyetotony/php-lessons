<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $title
 * @property string $description
 * @property string $cover_path
 * @property string $background_path
 * @property int $user_id
 */
class Channel extends Model
{
    protected $fillable = [
        'title',
        'description',
        'cover_path',
        'background_path',
        'user_id'
    ];

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}