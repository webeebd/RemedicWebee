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
        Schema::create('customer_cart', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('customers');
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idProduct')->references('id')->on('products');
            $table->integer('qty');  
            $table->timestamps();
            $table->index(['idUser']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_cart');
    }
};