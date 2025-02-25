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
        //
        Schema::table('abouts', function (Blueprint $table) {
            $table->smallInteger('python')->default(0)->nullable();
            $table->smallInteger('machinelearning')->default(0)->nullable();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn('python');
            $table->dropColumn('machinelearning');
        });
    }
};
