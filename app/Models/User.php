<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static filter(array $data)
 *
 * @property-read \App\Models\Role|null $role
 */
class User extends Authenticatable
{
    use HasFactory, HasFilter, Notifiable;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'login',
        'last_name',
        'first_name',
        'surname',
        'password',
        'ovd_id',
        'subdivision_id',
        'role_id',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return Attribute
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_ucfirst(mb_strtolower($value))
        );
    }

    /**
     * @return Attribute
     */
    protected function lastName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_ucfirst(mb_strtolower($value))
        );
    }

    /**
     * @return Attribute
     */
    protected function surname(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_ucfirst(mb_strtolower($value))
        );
    }

    /**
     * @return Attribute
     */
    protected function login(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower($value)
        );
    }

    /**
     * @return BelongsTo
     */
    public function ovd(): BelongsTo
    {
        return $this->belongsTo(OVD::class, 'ovd_id', 'id', 'ovd');
    }

    /**
     * @return BelongsTo
     */
    public function subdivision(): BelongsTo
    {
        return $this->belongsTo(Subdivision::class);
    }

    /**
     * @return HasMany
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role && $this->role->title === 'Администратор';
    }

    /**
     * @return bool
     */
    public function isModerator(): bool
    {
        return $this->role && $this->role->title === 'Модератор';
    }
}
