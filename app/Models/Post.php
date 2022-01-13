<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory, Sluggable;

    private $comments;

    public function sluggable(): array
    {
      return [
        'slug' => [
          'source' => 'title'
        ]
      ];
    }

    public function user(): BelongsTo
    {
      return $this->BelongsTo(User::class);
    }

    public function comments(): HasMany
    {
      return $this->hasMany(Comment::class);
    }

    public function scopeOrdered(Builder $builder): Builder
    {
      return $builder->orderByDesc('created_at')->orderByDesc('id');
    }
}