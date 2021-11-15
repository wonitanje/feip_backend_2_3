<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Models\Redirect;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangeNewsSlug extends Command
{
  protected $signature = 'change_news_slug {oldSlug} {newSlug}';

  protected $description = 'Command description';

  public function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    $oldSlug = $this->argument('oldSlug');
    $newSlug = $this->argument('newSlug');

    if ($oldSlug === $newSlug) {
      $this->error('Аргументы должны отличаться');
      return 1;
    }

    $from = route('news_item', ['slug' => $oldSlug], false);
    $to = route('news_item', ['slug' => $newSlug], false);
    $redirect = Redirect::query()
      ->where('old_slug', $from)
      ->where('new_slug', $to)
      ->first();
    if ($redirect !== null) {
      $this->error('Запись уже существует');
      return 1;
    }

    $news = News::where('slug', $oldSlug)->first();
    if ($news === null) {
      $this->error('Новость не найдена');
      return 1;
    }

    DB::transaction(function () use ($news, $newSlug, $to) {
      Redirect::where('old_slug', $to)->delete();

      $news->slug = $newSlug;
      $news->save();
    });

    return 0;
  }
}
