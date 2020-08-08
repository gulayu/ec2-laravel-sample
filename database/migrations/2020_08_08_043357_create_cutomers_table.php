<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->datetime('enter_time');
            $table->datetime('exit_time')->nullable();
            $table->integer('day_info');
            $table->integer('member_info');
            $table->integer('use_drinkbar')->nullable();
            $table->integer('under_jrhigh')->nullable();
            $table->integer('fee')->nullable();
            $table->text('memo')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
