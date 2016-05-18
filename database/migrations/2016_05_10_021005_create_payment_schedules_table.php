<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSchedulesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('payment_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id')
                    ->index()->references('id')->on('loans');
            $table->date('scheduled_date'); //date payment is scheduled
            //values down here are integers to beter manage decimals
            $table->integer('p_value'); //principal value 
            $table->integer('i_value'); //interest value
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('payment_schedules');
    }

}
