<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUser extends Migration
{
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string('login')->unique();
      $table->string('name')->nullable()->change();
      $table->string('email')->nullable()->change();
    });
  }

  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn(['login']);
      $table->string('name')->nullable(false)->change();
      $table->string('email')->unique()->nullable(false)->change();
    });
  }
}