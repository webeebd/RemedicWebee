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
        Schema::create('order_status', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('idOrder');
            $table->foreign('idOrder')->references('id')->on('orders');
            $table->string('status');
            $table->string('remarks');
            $table->timestamps();
            $table->index('idOrder');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_status');
    }
};