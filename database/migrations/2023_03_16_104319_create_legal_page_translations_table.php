<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_page_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('legal_page_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('locale')->index();
            $table->longText('body')->nullable();
            $table->unique(['legal_page_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legal_page_translations');
    }
};
