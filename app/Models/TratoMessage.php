<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TratoMessage extends Model
{
    protected $fillable = ['trato_id', 'sender_id', 'body'];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function trato(): BelongsTo
    {
        return $this->belongsTo(Trato::class);
    }
}
