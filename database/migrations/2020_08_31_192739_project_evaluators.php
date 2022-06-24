<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectEvaluators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->index(['id']);
        });

        Schema::create('project_evaluators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
//            $table->foreign('project_id')
//                ->references('id')
//                ->on('projects')
//                ->onDelete('cascade');
            $table->unsignedBigInteger('evaluator_id');
//            $table->foreign('evaluator_id')
//                ->references('id')
//                ->on('evaluators')
//                ->onDelete('cascade');
            $table->index(['id']);
            $table->index(['project_id', 'evaluator_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_evaluators');
        Schema::dropIfExists('evaluators');
    }
}
