<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRowsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_rows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('public_id');
            $table->string('path');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('project_row_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('value')->nullable();
            $table->unsignedBigInteger('project_row_id');
            $table->foreign('project_row_id')
                ->references('id')
                ->on('project_rows')
                ->onDelete('cascade');
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('note');
            $table->longText('comment');
            $table->timestamps();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
        Schema::dropIfExists('project_row_items');
        Schema::dropIfExists('project_rows');
    }
}
