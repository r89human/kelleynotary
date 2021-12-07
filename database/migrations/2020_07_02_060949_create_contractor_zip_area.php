<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorZipArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_zips', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('contractor user id');
            $table->string('state');
            $table->string('city');
            $table->string('zip');
            $table->integer('status')->comment('0=inactive, 1=active')->default(1);
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
        Schema::dropIfExists('contractor_zips');
    }
}
