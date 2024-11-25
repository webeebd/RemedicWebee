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
        Schema::create('products_media', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('url');
            $table->string('type');
            $table->char('active','1');    
            $table->timestamps();
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idProduct')->references('id')->on('products');
            $table->index(['idProduct', 'url']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_media');
    }
};