<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trato extends Model
{
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'product_id',
        'price',
        'sku',
        'payment_method',
        'status',
        'seller_confirmed',
        'buyer_confirmed',
    ];

    protected $casts = [
        'price'            => 'decimal:2',
        'seller_confirmed' => 'boolean',
        'buyer_confirmed'  => 'boolean',
    ];

    // Etiquetas legibles por estado para mostrar en la vista
    public const STATUS_LABELS = [
        'pedido_realizado' => 'PEDIDO REALIZADO',
        'en_discusion'     => 'EN DISCUSIÓN',
        'aprobado'         => 'APROBADO',
        'recibido'         => 'RECIBIDO',
        'cancelado'        => 'CANCELADO',
    ];

    // Orden numérico de los estados para la barra de progreso
    public const STATUS_ORDER = [
        'pedido_realizado' => 1,
        'en_discusion'     => 2,
        'aprobado'         => 3,
        'recibido'         => 4,
        'cancelado'        => 0,
    ];

    // El comprador del trato
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // El vendedor del trato
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // El producto negociado
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Solicitud de delivery asociada
    public function delivery(): HasOne
    {
        return $this->hasOne(Delivery::class);
    }

    // Mensajes del chat del trato
    public function messages(): HasMany
    {
        return $this->hasMany(TratoMessage::class)->orderBy('created_at');
    }

    // Retorna el label legible del estado actual
    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? strtoupper($this->status);
    }

    // ─── Methods ────────────────────────────────────────────────────────────────

    /**
     * Cancela un trato sin eliminar el registro (soft delete)
     */
    public function cancel(): void
    {
        $this->update(['status' => 'cancelado']);
    }
}
