<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $fillable = [
        'login',
        'last_name',
        'first_name',
        'surname',
        'password',
        'subdivision_id'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRoleNamesAttribute(): string
    {
        return $this->roles->isNotEmpty()
            ? $this->roles()->pluck('title')->implode(', ')
            : 'Пользователь';
    }

    public function subdivision(): BelongsTo
    {
        return $this->belongsTo(Subdivision::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin(): bool
    {
        return (bool)$this->roles->contains('title', 'Администратор');
    }

    public function isModerator(): bool
    {
        return (bool)$this->roles->contains('title', 'Модератор');
    }
}
