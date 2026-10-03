<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id', 'member_id', 'user_id', 'borrow_date', 'due_date',
        'return_date', 'status', 'notes'
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    /**
     * "Terlambat" adalah status komputasi, bukan nilai kolom:
     * peminjaman masih aktif (belum dikembalikan) dan sudah lewat jatuh tempo.
     */
    public function getIsOverdueAttribute(): bool
    {
        return in_array($this->status, ['borrowed', 'overdue'])
            && $this->due_date?->isPast();
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
