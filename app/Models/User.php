<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Filter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $name
 * @property string $email
 * @property bool $active
 * @property string $slug
 * @property string $password
 * @property Carbon $created_at
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Filter;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'slug'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function avatar(): HasOne
    {
        return $this->hasOne(Avatar::class);
    }

    public function avatarPath(): ?string
    {
        if ($this->avatar){
            $folderPath = $this->created_at->format('Y/m');

            return 'storage/' . $folderPath . '/' . $this->avatar->path;
        }

        return null;
    }

    public function getActiveTag(): string
    {
        if ($this->active){
            return '
        <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
            <span class="size-1.5 inline-block bg-green-600 rounded-full"></span>
            Active
        </span>';
        }

        return '
         <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
            <span class="size-1.5 inline-block bg-red-600 rounded-full"></span>
            Inactive
        </span>';
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    public function channels(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class);
    }

    public function myChannel(): HasOne
    {
        return $this->hasOne(Channel::class);
    }
}