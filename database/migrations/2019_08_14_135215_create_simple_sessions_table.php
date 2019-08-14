<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimpleSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simple_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->defualt('simple');
            // $table->integer('id_subject'); possibly reference
            $table->text()('description');
            $table->integer ('price');
            $table->string('state'); // etat
            $table->integer('nb_places');
            $table->string('cycle');
            $table->integer('specialité');
            $table->integer('year');
            $table->time('time');
            $table->date('date');
            $table->integer('duration');
            $table->integer('mark'); // note
            // $table->integer('id_document');
            $table->date('end_registration'); // date fin d'inscription
            $table->timestamps();
            
            // references
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')
                ->references('id')->on('teachers')
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
        Schema::dropIfExists('simple_sessions');
    }
}
