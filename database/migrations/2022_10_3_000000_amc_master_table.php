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
        Schema::create('amc_master', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name')->unique();
            $table->string('description')->nullable(); 
            $table->string('duration');
            $table->char('unit');
            $table->double('price', 8, 2);
            $table->string('type');
            $table->text('terms')->nullable(); 
            $table->text('offerings')->nullable(); 
            $table->char('active','1');    
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
        Schema::dropIfExists('amc_master');
    }
};