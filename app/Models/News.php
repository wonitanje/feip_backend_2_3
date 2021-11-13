<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string $text
 * @property bool $is_published
 * @property Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class News extends Model
{
  use HasFactory, Sluggable;

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }

  public function save(array $options = [])
  {
    if ($this->exists && $this->isDirty('slug')) {
      $oldSlug = $this->getOriginal('slug');
      $newSlug = $this->slug;

      $from = route('news_item', ['slug' => $oldSlug], false);
      $to = route('news_item', ['slug' => $newSlug], false);

      $redirect = new Redirect();
      $redirect->old_slug = $from;
      $redirect->new_slug = $to;
      $redirect->save();
    }
    return parent::save($options);
  }
}
