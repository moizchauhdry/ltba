<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('MEM#')->unique();
            $table->string('name');
            $table->string('father_name');
            $table->string('gender');
            $table->string('CNIC_NO')->unique();
            $table->string('date_of_birth');
            $table->string('city');
            $table->string('contact_no')->unique();
            $table->string('address');
            $table->string('member_based_on');
            $table->string('select_member_ship');
            $table->boolean('member_ship_fee_paid')->default(false); 
            $table->string('member_ship_fee_submission');
            $table->longText('remarks');
            $table->boolean('member_ship_status')->default(true); 
            $table->string('member_ship_reg_date');
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
        Schema::dropIfExists('members');
    }
}
