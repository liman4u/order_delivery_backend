<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->float('start_latitude',10,6);
            $table->float('start_longitude',10,6);
            $table->float('end_latitude',10,6);
            $table->float('end_longitude',10,6);
            $table->string('distance',75);
            $table->string('status',25);
            $table->timestamps();

            $table->index([
                'distance',
                'status'
            ], 'orderx_status');

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
