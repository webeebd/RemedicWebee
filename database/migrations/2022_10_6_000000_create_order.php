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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('customers');
            $table->double('discount', 8, 2);
            $table->double('tax', 8, 2);
            $table->double('subtotal', 8, 2);
            $table->double('delivery_charges', 8, 2);
            $table->double('cod_charges', 8, 2);
            $table->jsonb('discount_coupon');
            $table->double('total', 8, 2);
            $table->date('order_date', $precision = 0);
            $table->string('label');
            $table->string('billNumber');
            $table->timestamps();
            $table->index('idUser');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};