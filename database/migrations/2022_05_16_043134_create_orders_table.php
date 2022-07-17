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
            $table->string('no_resi');
            $table->string('jumlah_harga');

            $table->string('name_user');
            $table->text('alamat');

            $table->string('status_order');
            $table->string('pembayaran_id')->nullable();
            $table->string('id_cart');
            $table->string('opsikirim');
            $table->string('id_metode_pembayaran');

            $table->timestamp('order_date')->useCurrent();
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
