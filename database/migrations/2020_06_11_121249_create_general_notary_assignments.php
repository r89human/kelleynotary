<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralNotaryAssignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_notary_assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('assignment_title')->nullable();
            $table->string('date_of_assignment');
            $table->string('time_of_assignment')->nullable();
            $table->integer('number_of_signers')->default(0);
            $table->string('first_signers_name')->nullable();
            $table->string('second_signers_name')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('telephone_number2')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->text('special_instructions')->nullable();
            $table->string('file')->nullable();
            $table->integer('status')->default(0)->comment('0=pending, 1=received, 2=assigned,3=scheduled, 4=completed');
            $table->integer('assigned_to')->nullable();
            $table->date('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
            $table->string('hash');
            $table->string('assignment_type')->default('general_notary_assignments');
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
        Schema::dropIfExists('general_notary_assignments');
    }
}
