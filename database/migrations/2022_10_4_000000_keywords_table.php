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
        Schema::create('products_keyword', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('word');    
            $table->timestamps();
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idProduct')->references('id')->on('products');
            $table->index(['idProduct', 'word']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_keyword');
    }
};