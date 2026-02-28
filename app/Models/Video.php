<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $title
 * @property string $description
 * @property string $cover_path
 * @property string $path
 * @property string $genre
 * @property int $channel_id
 */
class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'cover_path',
        'path',
        'channel_id',
        'genre'
    ];


    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }
}