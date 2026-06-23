<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{
    protected $fillable = [
        'trato_id',
        'pickup_address',
        'delivery_address',
        'contact_name',
        'contact_phone',
        'shipping_type',
        'notes',
        'status',
        'courier_name',
        'courier_plate',
        'courier_phone',
        'admin_notes',
    ];

    public const STATUS_LABELS = [
        'pendiente'  => 'En espera',
        'aprobado'   => 'Aprobado',
        'rechazado'  => 'Rechazado',
        'en_camino'  => 'En camino',
        'entregado'  => 'Entregado',
    ];

    public function trato(): BelongsTo
    {
        return $this->belongsTo(Trato::class);
    }
}
