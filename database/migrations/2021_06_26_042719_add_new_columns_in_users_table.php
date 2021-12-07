<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('contact_telephone_number')->nullable();
            $table->string('contact_fax_number')->nullable();
            $table->string('contact_email_address')->nullable();
            $table->text('contact_mailing_address')->nullable();
            $table->string('cheque_payable_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('contact_first_name');
            $table->dropColumn('contact_last_name');
            $table->dropColumn('company_name');
            $table->dropColumn('contact_telephone_number');
            $table->dropColumn('contact_fax_number');
            $table->dropColumn('contact_email_address');
            $table->dropColumn('contact_mailing_address');
            $table->dropColumn('cheque_payable_to');
        });
    }
}
