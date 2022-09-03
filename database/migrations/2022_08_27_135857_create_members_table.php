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
            $table->string('mem_no')->nullable()->unique();
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->string('father_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('cnic_no')->unique();
            $table->string('birth_date')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_no')->unique()->nullable();
            $table->string('qualification')->nullable();
            $table->string('office_address')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('membership_based_on')->nullable();
            $table->string('mem')->nullable();
            $table->integer('mem_status')->default(0);
            $table->string('mem_reg_date')->nullable();
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
        Schema::dropIfExists('members');
    }
}
