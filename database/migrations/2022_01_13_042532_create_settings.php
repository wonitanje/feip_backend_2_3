<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
  public function up()
  {
    Schema::create('settings', function (Blueprint $table) {
      $table->id();
      $table->integer('max');
      $table->integer('frequency');
    });
  }

  public function down()
  {
    Schema::dropIfExists('settings');
  }
}