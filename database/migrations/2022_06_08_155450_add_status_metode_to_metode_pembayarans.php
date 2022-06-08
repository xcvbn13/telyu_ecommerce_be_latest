<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusMetodeToMetodePembayarans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metode_pembayarans', function (Blueprint $table) {
            $table->foreignId('id_status_metode');
            $table->foreign('id_status_metode')->references('id')->on('status_metode_pembayarans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metode_pembayarans', function (Blueprint $table) {
            //
        });
    }
}
