<?php

namespace App\Models\Tutorial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use App\Models\User;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_id', 'sub_title', 'contents', 'is_publish'
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d F Y')
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d F Y')
        );
    }

    /**
     * Get the title that owns the Tutorial
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function title(): BelongsTo
    {
        return $this->belongsTo(Title::class, 'title_id');
    }

    /**
     * Get all of the comments for the Tutorial
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'tutorial_id');
    }

}
