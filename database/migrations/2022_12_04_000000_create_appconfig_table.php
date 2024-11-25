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
        Schema::create('mobile_config', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('section');
            $table->string('type');
            $table->string('title');
            $table->string('subtitle');
            $table->string('body');
            $table->string('actionName');
            $table->string('actionLink');
            $table->string('colspan');
            $table->string('layout');
            $table->integer('position');
            $table->timestamps();
        });

        Schema::create('mobile_config_data', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('idSection');
            $table->integer('idProduct');
            $table->string('background');
            $table->string('imageUrl');
            $table->string('actionName');
            $table->string('actionLink');
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
        Schema::dropIfExists('mobile_config');
        Schema::dropIfExists('mobile_config_data');
    }
};
