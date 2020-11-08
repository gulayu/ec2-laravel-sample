<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number', 6)->comment('予約照会で使用するランダム生成の文字列');
            $table->datetime('booking_date')->comment('ユーザ入力のdateとtimeを結合してYYYYmmdd HH:ii:ssに変換した値');
            $table->integer('people')->comment('予約人数');
            $table->text('nickname')->comment('ニックネーム');
            $table->text('mail')->comment('メールアドレス');
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
        Schema::dropIfExists('bookings');
    }
}
