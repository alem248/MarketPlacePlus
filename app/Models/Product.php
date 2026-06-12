<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'location',
        'description',
        'price',
        'image_path',
        'deleted_images_log',
        'is_active',
        'condition', // estado: "Nuevo", "Usado - Como nuevo", "Usado"
        'tags',      // etiquetas JSON: ["Apple","Laptops","Premium"]
    ];

    protected $casts = [
        'is_active'          => 'boolean',
        'price'              => 'decimal:2',
        'image_path'         => 'array',
        'deleted_images_log' => 'array',
        'tags'               => 'array', // deserializa el JSON automáticamente
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('is_active', true);
    }

    // ─── Soft Delete Methods ────────────────────────────────────────────────────

    public function suspend(string $reason = null): void
    {
        $this->update([
            'is_active' => false,
            'suspension_reason' => $reason,
        ]);
    }

    public function reactivate(): void
    {
        $this->update([
            'is_active' => true,
            'suspension_reason' => null,
        ]);
    }
}
