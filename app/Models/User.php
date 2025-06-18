<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static filter(array $data)
 */
class User extends Authenticatable
{

    use HasFactory, Notifiable, HasFilter;

    protected $fillable = [
        'login',
        'last_name',
        'first_name',
        'surname',
        'password',
        'subdivision_id',
        'role_id'
    ];


    protected $hidden = [
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_ucfirst(mb_strtolower($value))
        );
    }

    protected function lastName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_ucfirst(mb_strtolower($value))
        );
    }

    protected function surname(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_ucfirst(mb_strtolower($value))
        );
    }

    protected function login(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtolower($value)
        );
    }

    public function ovd(): BelongsTo
    {
        return $this->belongsTo(OVD::class, 'ovd_id', 'id', 'ovd');
    }

    public function subdivision(): BelongsTo
    {
        return $this->belongsTo(Subdivision::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->role->title === 'Администратор';
    }

    public function isModerator(): bool
    {
        return $this->role->title === 'Модератор';
    }
}
