<?php

namespace Unity3_Vendor;

use Unity3_Vendor\Illuminate\Support\Facades\Schema;
use Unity3_Vendor\Illuminate\Database\Schema\Blueprint;
use Unity3_Vendor\Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
\class_alias('Unity3_Vendor\\CreateUsersTable', 'CreateUsersTable', \false);
