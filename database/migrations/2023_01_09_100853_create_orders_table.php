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
            $table->bigIncrements('id');
            $table->datetime('ordered_at');
            $table->bigInteger('user_id');
            $table->boolean('order_status');
            $table->datetime('estiimated_delivery_time');
            $table->integer('tax');
            $table->string('memo')->nullable();
            $table->string('address');
            $table->string('tel');
            $table->integer('total_money');
            $table->integer('syouyu')->nullable();
            $table->integer('hashi')->nullable();
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
