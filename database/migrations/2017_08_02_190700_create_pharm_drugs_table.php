<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharm_drugs', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('pharmacy_id');
            $table->integer("drug_id")->unsigned();
            $table->integer("unit_id")->unsigned();
            $table->integer("strength_id")->unsigned();
            $table->string("batch_number", 200)->nullable();
            $table->date("manufactured_date")->nullable();
            $table->date("import_date")->nullable();
            $table->date("expiring_date");
            $table->text("comment")->nullable();
            $table->primary('id');
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
        Schema::dropIfExists('pharm_drugs');
    }
}
