<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('order_date')->useCurrent();

            $table->foreignId('product_id');
            $table->foreignId('user_id');
            $table->foreignId('status_order_id');
            $table->foreignId('pembayaran_id');
            $table->foreignId('id_orders_detail');

            $table->foreign('id_orders_detail')->references('id')->on('orders_details');
            $table->foreign('pembayaran_id')->references('id')->on('pembayarans');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_order_id')->references('id')->on('status_orders');
            
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
        Schema::dropIfExists('orders');
    }
}
