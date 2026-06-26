<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'zone',
        'image_path',
        'link_url',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'end_date'  => 'date',
        'is_active' => 'boolean',
    ];

    // ─── Soft Delete Methods ────────────────────────────────────────────────────

    public function suspend(): void
    {
        $this->update(['is_active' => false]);
    }

    public function reactivate(): void
    {
        $this->update(['is_active' => true]);
    }
}
