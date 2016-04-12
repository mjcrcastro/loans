<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('first_lastname');
            $table->string('second_lastname');
            $table->date('birthdate');
            $table->string('identification');
            $table->integer('country_id')
                ->index()->references('id')->on('countries');
            $table->integer('department_id')
                ->index()->references('id')->on('departments');
            $table->integer('municipality_id')
                ->index()->references('id')->on('municipalities');
            $table->string('address');
            $table->string('phones');
            $table->string('occupation_id');
            $table->string('picture');
            $table->string('email');
            $table->string('taxid'); //RUC in this case
            $table->integer('employer_id') //employer could be a potential client
                    ->index()->references('id')->on('contacts');
            $table->string('notes');
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
        Schema::drop('contacts');
    }
}
