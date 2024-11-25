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
        Schema::create('products_warehouse', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('qty');   
            $table->integer('month_key');  
            $table->integer('week_key'); 
            $table->string('remarks');  
            $table->string('billNo'); 
            $table->string('supplier');
            $table->integer('returnedQty');
            $table->timestamps();
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idProduct')->references('id')->on('products');
            $table->index(['idProduct', 'qty']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_warehouse');
    }
};