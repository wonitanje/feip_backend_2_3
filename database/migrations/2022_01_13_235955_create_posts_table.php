<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
  public function up()
  {
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      $table->string('slug', 100)->unique();
      $table->string('title', 100);
      $table->text('text');
      $table->foreignId('user_id')->constrained()->restrictOnDelete();
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('posts');
  }
}