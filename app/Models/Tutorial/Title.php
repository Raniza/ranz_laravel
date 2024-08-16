<?php

namespace App\Models\Tutorial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Carbon\Carbon;

class Title extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'prologue', 'user_id', 'is_final'];

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ucwords($value)
        );
    }

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
     * Get the category that owns the Title
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the tutorials for the Title
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tutorials(): HasMany
    {
        return $this->hasMany(Tutorial::class);
    }

    /**
     * Get the author that owns the Title
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'email', 'role');
    }
}
