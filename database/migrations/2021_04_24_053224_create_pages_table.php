<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->enum('language', ['en', 'ta']);
            $table->string('slug', 255);
            $table->string('keywords', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->text('content')->nullable();
            $table->boolean('show_in_menu')->default(false);
            $table->unsignedBigInteger('menu_order')->nullable();
            $table->string('menu_icon')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
