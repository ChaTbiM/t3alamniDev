<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoinGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nb_absences');
            $table->boolean('is_paid');
            $table->boolean('is_validated');
            $table->time('time');
            $table->date('date');

            $table->unsignedBigInteger('group_id')->nullable();
            $table
                ->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('restrict');

            $table->unsignedBigInteger('student_id')->nullable();
            $table
                ->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('restrict');

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
        Schema::dropIfExists('join_groups');
    }
}
