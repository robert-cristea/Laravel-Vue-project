<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('department')->nullable();
            $table->string('login_count')->default(false);
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
            $table->dropColumn('phone');
            $table->dropColumn('fax');
            $table->dropColumn('reg_no');
            $table->dropColumn('website');
            $table->dropColumn('address');
            $table->dropColumn('department');
            $table->dropColumn('login_count');
        });
    }
}
