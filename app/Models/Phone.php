<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property string $number
 * @property int $user_id
 * @property int $phone_brand_id
 */
class Phone extends Model
{
    /** @use HasFactory<\Database\Factories\PhoneFactory> */
    use HasFactory;

    protected $fillable = [
        'number',
        'user_id',
        'phone_brand_id',
    ];

    protected $table = 'phones';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function phoneBrand(): BelongsTo
    {
        return $this->belongsTo(PhoneBrand::class);
    }
}