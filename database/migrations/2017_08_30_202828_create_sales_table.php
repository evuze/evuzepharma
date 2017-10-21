<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id'); //uuid as id
            $table->string('particulars');
            $table->string('vch_type'); //Voucher Type
            $table->string('vch_no'); // Voucher No (incremental)
            $table->string('amount_dbt'); //amount debit
            $table->string('amount_cdt');// amount credit
            $table->timestamps();

            //setting primary key
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
        Schema::dropIfExists('sales');
    }
}
