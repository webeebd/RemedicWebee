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
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('idOrder');
            $table->foreign('idOrder')->references('id')->on('orders');
            $table->string('payment_mode');
            $table->string('payment_status');
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
        Schema::dropIfExists('order_payments');
    }
};