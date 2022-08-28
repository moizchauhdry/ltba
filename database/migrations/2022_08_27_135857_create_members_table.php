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
            $table->string('mem_id')->unique();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('cnic_no')->unique();
            $table->string('date_of_birth')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_no')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('membership_based_on')->nullable();
            $table->string('select_member_ship')->nullable();
            $table->string('member_ship_fee_submission')->nullable();
            $table->longText('remarks')->nullable();
            $table->boolean('member_ship_status')->default(true); 
            $table->string('member_ship_reg_date')->nullable();
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
