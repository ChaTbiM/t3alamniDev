<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number');
            $table->integer('monthly_price');
            $table->integer('nb_places');
            $table->string('cycle');
            $table->string('specialty');
            $table->integer('year');
            // $table->integer('id_module'); reference to module

            $table->timestamps();

            // teacher specialty
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table
                ->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->onDelete('cascade');
            //student specialty
            $table->unsignedBigInteger('student_id')->nullable();
            $table
                ->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
