<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiometricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biometrics', function (Blueprint $table) {
            $table->id();
            $table->string('member_no', 100);
            $table->string('member_name', 100)->nullable();
            $table->string('finger', 100)->nullable();
            $table->boolean('status')->default(0);
            $table->longText('template_xml')->nullable();
            $table->longText('template_binary')->nullable();
            $table->string('sync_id', 100)->nullable();
            $table->string('veri', 100)->nullable();
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
        Schema::dropIfExists('biometrics');
    }
}
