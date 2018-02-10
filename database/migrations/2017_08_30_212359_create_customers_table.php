<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id'); // uui as id
            $table->string('names');
            $table->string('sex');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('dob')->nullable();
            $table->string('weight')->nullable();
            $table->longText('illness')->nullable();
            $table->string('nameofprincipal')->nullable();
            $table->string('cardnumber')->nullable();
            $table->string('medicalcenter')->nullable();
            $table->integer('insurance_id')->unsigned();
            $table->timestamps();

            //setting prmary key
            $table->primary('id');
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
