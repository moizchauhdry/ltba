<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_name');
            $table->integer('voucher_type');
            $table->string('bank_name')->nullable();
            $table->string('voucher_file')->nullable();
            $table->string('paid_date')->nullable();
            $table->bigInteger('policy_id')->nullable();
            $table->timestamps();
            $table->string('transaction_id')->nullable();
            $table->boolean('online_banking')->default(true); 
            $table->boolean('is_voucher_print')->default(true); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
