<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentAssignedToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments_assign_to', function (Blueprint $table) {
            $table->id();
            $table->string('assignment_hash');

            $table->unsignedBigInteger('assign_to');
            $table->foreign('assign_to')->references('id')->on('users');


            $table->unsignedBigInteger('assign_by');
            $table->foreign('assign_by')->references('id')->on('users');

            $table->string('assignment_type');
            $table->text('special_instruction')->nullable();
            $table->text('instruction_file')->nullable();
            $table->double('paid_to_contractor');


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
        Schema::dropIfExists('assignments_assign_to');
    }
}
