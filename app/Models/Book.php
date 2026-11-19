<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'isbn', 'description', 'cover', 'quantity', 'available',
        'published_year', 'publisher', 'category_id'
    ];

    /**
     * URL cover buku: file upload di disk public,
     * atau placeholder lokal bila buku belum punya cover.
     * Bila file upload belum ada di disk (mis. seeder belum jalan,
     * atau deploy read-only seperti Vercel), pakai salinan cover
     * yang ikut ter-commit di public/covers/.
     */
    public function getCoverUrlAttribute(): string
    {
        if ($this->cover) {
            if (Storage::disk('public')->exists($this->cover)) {
                return Storage::url($this->cover);
            }

            if (file_exists(public_path($this->cover))) {
                return asset($this->cover);
            }

            return Storage::url($this->cover);
        }

        return asset('images/cover-placeholder.svg');
    }

    protected $casts = [
        'published_year' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class);
    }
}
