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
            $table->string('type')->default('simple');
            $table->string('state'); // etat - en attente , en cour , terminer
            $table->string('subject'); // titre 
            $table->string('cycle'); // niveau
            $table->string('specialty'); 
            $table->integer('year');
            $table->text('description');
            $table->date('date');
            $table->time('time');
            $table->integer('duration');
            $table->integer('nb_places');
            $table->smallInteger('price');
            $table->integer('mark')->nullable(); // note
            // $table->integer('id_document');
            $table->date('end_registration')->nullable(); // date fin d'inscription
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
