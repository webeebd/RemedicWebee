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
        Schema::create('order_amcs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('idAmc');
            $table->foreign('idAmc')->references('id')->on('amc_master');
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idProduct')->references('id')->on('products');
            $table->unsignedBigInteger('idOrder');
            $table->foreign('idOrder')->references('id')->on('orders');
            $table->unsignedBigInteger('idAddress')->nullable();
            $table->foreign('idAddress')->references('id')->on('customer_address');
            $table->jsonb('feedback')->nullable();
            $table->jsonb('report')->nullable();
            $table->string('status')->nullable();
            $table->string('amcNumber');
            $table->string('remark')->nullable();
            $table->char('video_call',1)->nullable();
            $table->dateTime('visit', $precision = 0)->nullable();
            $table->date('validity', $precision = 0)->nullable();
            $table->char('claimed',1);
            $table->char('type',1);
            $table->timestamps();
            $table->index('idOrder');
            $table->index('idAmc');
            $table->index('idProduct');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_amcs');
    }
};