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
        Schema::create('order_returns', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idProduct')->references('id')->on('products');
            $table->unsignedBigInteger('idOrderDetails');
            $table->foreign('idOrderDetails')->references('id')->on('order_details');
            $table->string('billNumber');
            $table->double('refund_amount', 8, 2);
            $table->date('return_date', $precision = 0);
            $table->string('status');
            $table->string('label');
            $table->string('additional_info');
            $table->timestamps();
            $table->index(['idProduct','idOrderDetails']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_returns');
    }
};