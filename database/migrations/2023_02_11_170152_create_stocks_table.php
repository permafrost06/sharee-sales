<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['in', 'out']);
            $table->string('brand');
            $table->string('item_code');
            $table->unsignedInteger('quantity');
            $table->string('supplier_name');
            $table->string('supplier_contact');
            $table->string('carrier_name');
            $table->string('carrier_contact');
            $table->string('border');
            $table->tinyText('remarks');
            $table->dateTime('date_time');

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
        Schema::dropIfExists('stocks');
    }
};
