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
        Schema::create('customers', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('business_name')->nullable();
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('forgot_token')->nullable();
            $table->char('active','1');  
            $table->char('verified','1'); 
            $table->timestamps();
            $table->index('email');
            $table->index('mobile');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};