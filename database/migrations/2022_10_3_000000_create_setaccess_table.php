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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('idRole');
            $table->bigInteger('idPermission'); 
            $table->char('active','1'); 
            $table->char('visible','1')->nullable();     
            $table->timestamps();
            $table->index(['idRole', 'idPermission']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
};