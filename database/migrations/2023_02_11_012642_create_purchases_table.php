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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id');
            $table->string('memo_number')->nullable();
            $table->string('date');
            $table->string('quantity');
            $table->string('mark');
            $table->string('ball');
            $table->double('goods_of_issues');
            $table->double('paid_money');
            $table->double('balance_due')->nullable();
            $table->string('comment')->nullable();
            

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
        Schema::dropIfExists('purchases');
    }
};
