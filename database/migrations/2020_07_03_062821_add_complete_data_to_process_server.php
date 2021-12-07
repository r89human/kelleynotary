<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompleteDataToProcessServer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process_server_assignments', function (Blueprint $table) {
            //
            $table->integer('assignment_complete_status')->nullable()->comment('1=success, 2=cancelled');
            $table->text('assignment_complete_comment')->nullable();
            $table->dateTime('completed_date_time')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process_server_assignments', function (Blueprint $table) {
            //
        });
    }
}
