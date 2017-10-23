<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPharmDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharm_drugs', function($table){
            $table->integer('quantity')->after('batch_number')->default(0);
            $table->integer('init_quantity')->after('quantity')->default(0);
            $table->string("supplier")->after('init_quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharm_drugs', function ($table) {
            $table->dropColumn('quantity');
            $table->dropColumn('init_quantity');
            $table->dropColumn('supplier');
        });
    }
}
