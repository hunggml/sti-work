<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_support', function (Blueprint $table) {
            $table->id();
            $table->string('customerName');
            $table->date('date');
            $table->string('status');
            $table->string('result');
            $table->dateTime('time_created')->nullable();
            $table->dateTime('time_updated')->nullable();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_support');
    }
}
