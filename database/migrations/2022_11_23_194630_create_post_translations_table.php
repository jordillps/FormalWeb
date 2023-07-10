<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title', 400);
            $table->mediumText('excerpt')->nullable();
            $table->text('iframe')->nullable();
            $table->longText('body')->nullable();
            $table->unique(['post_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translations');
    }
}
