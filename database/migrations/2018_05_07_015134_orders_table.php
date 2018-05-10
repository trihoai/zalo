<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersTable extends Migration
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
            $table->string('zaloOrderId');
            $table->string('productId');
            $table->integer('userId');
            $table->string('customerName');
            $table->char('customerPhone', 15);;
            $table->string('deliverAddress');
            $table->integer('price');
            $table->integer('numItem');
            $table->integer('paymentMethod');
            $table->integer('paymentStatus');
            $table->integer('status');
            $table->string('orderCode');
            $table->dateTime('createdTime');
            $table->dateTime('updatedTime');
            $table->string('productName');
            $table->string('deliverCity');
            $table->string('deliverDistrict');
            $table->string('productImage');
            $table->string('cancelReason');
            $table->string('productCode');
            $table->timestamps();
        });
    }
            // "id": String,
            // "oaId": long,
            // "userId": long,
            // "customerName": String,
            // "customerPhone": long,
            // "deliverAddress" String,
            // "price": long,
            // "numItem": int,
            // "productId": String,
            // "paymentMethod": int,
            // "paymentStatus": int, có ý nghĩa nếu đơn hàng thanh toán online qua Zalo, 2: đã thanh toán, 1: chưa thanh toán
            // "status": int,
            // "orderCode": string,
            // "createdTime": long,
            // "updatedTime": long,
            // "productName": String,
            // "deliverCity": String,
            // "deliverDistrict": String,
            // "productImage": String,
            // "cancelReason": String,
            // "productCode": String

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
