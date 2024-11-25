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
        Schema::create('customer_notifications', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('customers');
            $table->string('type');
            $table->string('notification');
            $table->string('slug');
            $table->char('isRead',1);
            $table->string('category');
            $table->string('ribbon');   
            $table->timestamps();
            $table->index('idUser');
            $table->index(['idUser','type']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_notifications');
    }
};