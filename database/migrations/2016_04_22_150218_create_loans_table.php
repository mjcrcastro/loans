<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('borrower_id') //the borrower
                    ->index()->references('id')->on('contacts');
            $table->date('approval_date'); //date the loan was approved
            $table->integer('fund_id')
                    ->index()->references('funds')->on('id');
            $table->integer('loan_category_id')
                    ->index()->references('loan_categories')->on('id');
            $table->integer('guarantor_id')
                    ->index()->references('guarantors')->on('id');
            $table->integer('loan_status_id')
                    ->index()->references('loan_status')->on('id');
            $table->integer('agent_id') //agent managing customer relationship
                    ->index()->references('contacts')->on('id');
            $table->decimal('principal',8,2); //TODO update the size of this field for bigger loans
            $table->integer('term_id'); //loan term type
            $table->integer('term_value'); //loan term value
            $table->decimal('loan_rate',4,2); //interest rate
            $table->decimal('late_fee',4,2); //interest rate
            $table->string('contract_URL'); //URL to a picture of the actual contract
            //notes on this loan will be on a separated table.
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
        Schema::drop('loans');
    }
}
