<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('concessionaire_name');
            $table->string('image')->nullable();
            $table->string('region')->nullable();
            $table->string('highway_name')->nullable();
            $table->string('code')->nullable();
            $table->string('abbreviation')->nullable();
            $table->string('kilometer_from')->nullable();
            $table->string('kilometer_to')->nullable();
            $table->string('length')->nullable();
            $table->string('planning_percentage')->nullable()->default('0');
            $table->string('construction_percentage')->nullable()->default('0');
            $table->string('existing_percentage')->nullable()->default('0');
            $table->string('construction_start')->nullable();
            $table->string('construction_completion')->nullable();
            $table->string('open_to_public')->nullable();
            $table->string('assessment_year', false, true)->nullable();
            $table->integer('report_period', false, true)->nullable();
            $table->longText('settings')->nullable();
            $table->longText('construction_header')->nullable();
            $table->longText('construction_footer')->nullable();
            $table->longText('construction_work_values')->nullable();
            $table->tinyInteger('lanes')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->softDeletes('deleted_at');
            $table->integer('status_val')->default(0);
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
        Schema::dropIfExists('projects');
    }
}
