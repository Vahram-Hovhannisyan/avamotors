<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total',
        'name',
        'phone',
        'email',
        'address',
        'comment',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    // ── Statuses ──────────────────────────────────────

    const STATUSES = [
        'pending'   => 'Новый',
        'confirmed' => 'Подтверждён',
        'shipped'   => 'Отправлен',
        'delivered' => 'Доставлен',
        'cancelled' => 'Отменён',
    ];

    const STATUS_COLORS = [
        'pending'   => 'orange',
        'confirmed' => 'blue',
        'shipped'   => 'purple',
        'delivered' => 'green',
        'cancelled' => 'red',
    ];

    // ── Relations ─────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // ── Helpers ───────────────────────────────────────

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function statusColor(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'muted';
    }

    public function formattedTotal(): string
    {
        return number_format($this->total, 0, '.', ' ') . ' դր.';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }
}
