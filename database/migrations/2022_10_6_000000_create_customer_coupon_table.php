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
        Schema::create('product_discounts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('idUser')->nullable();
            $table->foreign('idUser')->references('id')->on('customers');
            $table->char('type');
            $table->jsonb('instructions');
            $table->string('code');
            $table->char('amount_type');
            $table->float('amount_unit', 8, 2);
            $table->integer('max_count');
            $table->integer('current_count'); 
            $table->string('description');  
            $table->dateTime('valid_till', $precision = 0);
            $table->char('active',1);
            $table->timestamps();
            $table->index(['code', 'idUser']);
            $table->index(['code']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_discounts');
    }
};