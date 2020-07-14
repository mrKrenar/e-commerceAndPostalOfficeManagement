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
            $table->string('receiver_name');
            $table->string('receiver_tel');
            $table->string('receiver_tel2')->nullable();
            $table->string('state');
            $table->string('city');
            $table->string('address')->nullable();
            $table->integer('quantity');
            $table->integer('weight')->nullable();
            $table->string('order_type');
            $table->boolean('is_openable');
            $table->boolean('is_returnable');
            $table->string('additional_notes')->nullable();
            $table->string('order_name');
            $table->string('description')->nullable();
            $table->float('price');
            $table->float('total_price');
            $table->string('status');
            $table->foreignId('seller_id')->constrained('users', 'id');
            $table->foreignId('poster_id')->nullable()->constrained('users', 'id');
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
