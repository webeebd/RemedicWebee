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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idProduct')->references('id')->on('products');
            $table->unsignedBigInteger('idOrder');
            $table->foreign('idOrder')->references('id')->on('orders');
            $table->unsignedBigInteger('idAddress');
            $table->foreign('idAddress')->references('id')->on('customer_address');
            $table->string('shipmentNumber');
            $table->string('orderNumber');
            $table->string('shipment_detail');
            $table->string('shipment_partner');
            $table->string('shipment_link');
            $table->integer('qty');
            $table->string('size');
            $table->double('unit_price', 8, 2);
            $table->double('base_price', 8, 2);
            $table->double('discount', 8, 2);
            $table->double('tax', 8, 2);
            $table->double('subtotal', 8, 2);
            $table->jsonb('discount_coupon');
            $table->double('total', 8, 2);
            $table->double('delivery_charges', 8, 2);
            $table->double('cod_charges', 8, 2);
            $table->date('order_date', $precision = 0);
            $table->date('warranty_valid', $precision = 0);
            $table->date('ship_date', $precision = 0);
            $table->char('isReturn',1);
            $table->integer('return_qty');
            $table->string('status');
            $table->string('label');
            $table->string('additional_info');
            $table->char('active',1);
            $table->timestamps();
            $table->index(['idProduct','idOrder']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};