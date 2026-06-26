<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Roles disponibles
    const ROLE_ADMIN = 'admin';
    const ROLE_USER  = 'user';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'dob',
        'gender',
        'role',
        'is_active',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'dob'               => 'date',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    // ─── Soft Delete Methods ────────────────────────────────────────────────────

    public function suspend(): void
    {
        $this->update(['is_active' => false]);
    }

    public function reactivate(): void
    {
        $this->update(['is_active' => true]);
    }

    // ─── Relations ──────────────────────────────────────────────────────────────

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
