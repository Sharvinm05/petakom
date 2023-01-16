<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); 
            $table->string('eventname');
            $table->datetime('datetime');
            $table->integer('budget');
            $table->datetime('closingdate');
            $table->integer('capacity');
            $table->string('venue');
            $table->text('description');
            $table->boolean('coordinatorstatus')->nullable();
            $table->boolean('deanstatus')->nullable();
            $table->boolean('eventstatus')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_records');
    }
}
