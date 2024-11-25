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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('title');
            $table->text('short_description');
            $table->text('description')->nullable();
            $table->string('pic');
            $table->string('modelNumber');
            $table->string('genericName')->nullable();
            $table->string('manufacture')->nullable();
            $table->string('skuc_code')->nullable();
            $table->string('hsn_code');
            $table->string('country_origin')->nullable();
            $table->string('pack_size')->nullable();
            $table->text('warranty')->nullable();
            $table->jsonb('keypoints')->nullable();
            $table->string('slug')->nullable();
            $table->jsonb('other_details')->nullable();
            $table->char('active','1');    
            $table->integer('stock')->nullable();
            $table->integer('stockAlert')->nullable();
            $table->char('minBuy','1')->nullable();
            $table->integer('minStock')->nullable();
            $table->integer('tax')->nullable();
            $table->char('maxBuy','1')->nullable();
            $table->integer('maxStock')->nullable();
            $table->double('sales_price', 8, 2);
            $table->float('tax_amount', 4, 2);
            $table->double('purchase_price', 8, 2);
            $table->double('max_retail_price', 8, 2);
            $table->double('pre_discount', 8, 2)->nullable();
            $table->unsignedBigInteger('amc_id');
            $table->foreign('amc_id')->references('id')->on('amc_master');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->timestamps();
            $table->index(['slug']);
            $table->index(['amc_id', 'name']);
            $table->index(['department_id']);
            $table->index(['category_id', 'name']);
            $table->index(['brand_id', 'name']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};