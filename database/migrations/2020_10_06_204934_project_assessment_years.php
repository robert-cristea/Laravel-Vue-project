<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectAssessmentYears extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('assessment_years')->nullable();
            $table->integer('certified_1')->default(50);
            $table->integer('certified_2')->default(60);
            $table->integer('silver_1')->default(61);
            $table->integer('silver_2')->default(70);
            $table->integer('gold_1')->default(71);
            $table->integer('gold_2')->default(80);
            $table->integer('platinum_1')->default(81);
            $table->integer('platinum_2')->default(100);
            $table->text('score_awards_totals')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('assessment_years');
            $table->dropColumn('certified_1');
            $table->dropColumn('certified_2');
            $table->dropColumn('silver_1');
            $table->dropColumn('silver_2');
            $table->dropColumn('gold_1');
            $table->dropColumn('gold_2');
            $table->dropColumn('platinum_1');
            $table->dropColumn('platinum_2');
            $table->dropColumn('score_awards_totals');
        });
    }
}
