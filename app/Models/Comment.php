<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'content',
        'rating',
        'is_active',
        'admin_message', // Agregado
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating'    => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // ─── Métodos de estado actualizados ──────────────────────────────────────────

    public function hide(string $reason = null): void
    {
        $this->update([
            'is_active' => false,
            'admin_message' => $reason
        ]);
    }

    public function show(): void
    {
        $this->update([
            'is_active' => true,
            'admin_message' => null // Limpiamos el mensaje al reactivar
        ]);
    }
}