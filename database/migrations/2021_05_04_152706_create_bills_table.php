<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("category_id");
            $table->integer("image_id");
            $table->string("seller")->nullable();
            $table->integer("total")->nullable();
            $table->date("payment_date")->nullable();
            $table->string("address")->nullable();
            $table->string("note")->nullable();
            $table->integer("status");
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
        Schema::dropIfExists('bills');
    }
}
