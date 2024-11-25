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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->char('type','1'); 
            $table->char('unit','1');  
            $table->double('total', 8, 2);  
            $table->double('min_amount', 8, 2);  
            $table->date('expire_date', $precision = 0); 
            $table->integer('max_redeem');
            $table->integer('current_redeem');
            $table->char('active','1');  
            $table->jsonb('logic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
};
