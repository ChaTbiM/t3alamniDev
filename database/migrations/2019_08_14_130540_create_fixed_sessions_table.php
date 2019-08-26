<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixedSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default('fixed');
            $table->string('state'); // etat_sess
            
            // $table->smallInteger('price')->unsigned();
            // $table->tinyInteger('nb_places')->unsigned();
            

            $table->time('time');
            $table->date('date');
            $table->tinyInteger('duration');
            $table->tinyInteger('mark')->nullable();  // note
            $table->timestamps();

            //references
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')
                ->references('id')->on('groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')
                ->references('id')->on('teachers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixed_sessions');
    }
}
