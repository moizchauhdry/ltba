<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('voucher_no')->references('id')->on('vouchers');
            $table->bigInteger('member_id')->unsigned();
            $table->bigInteger('voucher_no')->unsigned();
            $table->integer('payment_status')->nullable();
            $table->integer('payment_type')->nullable();
            $table->double('amount', 10, 2)->default(0);
            $table->boolean('acct_dept_payment_status')->default(true); 
            $table->boolean('approved')->default(true); 
            $table->bigInteger('approved_at')->nullable();
            $table->bigInteger('approved_by')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->string('mem_fee_submission_date')->nullable();
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
