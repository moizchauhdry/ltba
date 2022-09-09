<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionSeatCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('election_seat_candidates', function (Blueprint $table) {
            $table->id();
            $table->foreign('election_id')->references('id')->on('elections');
            $table->foreign('seat_id')->references('id')->on('seats');
            $table->foreign('member_id')->references('id')->on('members');
            $table->bigInteger('election_id')->unsigned();
            $table->bigInteger('seat_id')->unsigned();
            $table->bigInteger('member_id')->unsigned();
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
        Schema::dropIfExists('election_seat_candidates');
    }
}
