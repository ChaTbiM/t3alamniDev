<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSingInSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sing_in_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('presence');
            $table->boolean('is_validated');

            $table->time('time');
            $table->date('date');

            $table->unsignedBigInteger('student_id')->nullable();
            $table
                ->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('restrict');

            $table->unsignedBigInteger('simple_session_id')->nullable();
            $table
                ->foreign('simple_session_id')
                ->references('id')
                ->on('simple_sessions')
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
        Schema::dropIfExists('sing_in_sessions');
    }
}
