<?php

namespace Unity3_Vendor;

use Unity3_Vendor\Illuminate\Support\Facades\Schema;
use Unity3_Vendor\Illuminate\Database\Schema\Blueprint;
use Unity3_Vendor\Illuminate\Database\Migrations\Migration;
class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
\class_alias('Unity3_Vendor\\CreatePasswordResetsTable', 'CreatePasswordResetsTable', \false);
