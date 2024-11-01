<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Carbon\Carbon;

class ProjectComment extends Model
{
    use HasFactory;

    protected $fillable = ['project_content_id', 'user_id', 'comment', 'is_approve'];

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

    public function scopeApproved(Builder $query): void
    {
        $query->where('is_approve', 1);
    }
    
    public function scopeNotApproved(Builder $query): void
    {
        $query->where('is_approve', 0);
    }

    /**
     * Get the content that owns the ProjectComent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(ProjectContent::class, 'project_content_id');
    }

    /**
     * Get the user that owns the ProjectComent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'email', 'updated_at');
    }
}
